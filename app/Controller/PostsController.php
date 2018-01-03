<?php session_start(); ?>
<?php
	class PostsController extends AppController {
		public $name = "Posts";
		public $AMOUNT_OF_POST_EACH_PAGE = 5;

		function index_oldVersion() {
			$this->index();
		}

		function index() {
			// Hiển thị thông tin sau khi user vừa đăng bài
			if(isset($_SESSION['infoAfterAddPost'])) {
				$this->set("infoString", $_SESSION['infoAfterAddPost']);
				unset($_SESSION['infoAfterAddPost']);
			}
			
			// Tìm tổng số bài có trong DB để phân trang
			if(!isset($_SESSION['amountOfPages'])) {
				$sql_amount_of_posts = "SELECT total_posts FROM count_posts";
				$totalPosts = $this->Post->query($sql_amount_of_posts);
				$_SESSION['amountOfPages'] = ceil($totalPosts[0]['count_posts']['total_posts']/$this->AMOUNT_OF_POST_EACH_PAGE);
			}

			// chú ý là tại trang đầu tiên thì $_GET['page'] = 1, nhưng $sid = 0
			if(isset($_GET['page'])) {
				if(is_numeric($_GET['page'])) {
					$sid = ($_GET['page'] - 1)*$this->AMOUNT_OF_POST_EACH_PAGE;
					$this->set("currentPage", $_GET['page']);
				} else {
					$sid = -1;
					$this->set("errorPageNumber", "Error! Page number is invalid!");
				}
			} else {
				$sid = 0;
				$this->set("currentPage", 1);
			}
			
			if($sid < 0) {
				// trường hợp này nhập tham số ko hợp lệ (có thể là: ?page=-1, ?page=abc...)
				// do đó ta sẽ ko hiển thị cái gì!
				$sid = 0;	//sid = start id
				$amountOfPostsEachPage = 0;
			} else {
				$amountOfPostsEachPage = $this->AMOUNT_OF_POST_EACH_PAGE;
			}
			
			//============= Query =====================//
			$sql_show_posts = "SELECT p.id, u.id, u.name, p.content, p.time, p.hashtag, p.num_of_comments
					FROM posts p, users u
					where p.user_id = u.id
					order by p.id desc
					limit $sid,$amountOfPostsEachPage;";

			$tenNewestPosts = $this->Post->query($sql_show_posts);
			$commentOf10Post = array();
			//print_r($tenNewestPosts);
			$this->set("tenNewestPosts", $tenNewestPosts);
			foreach ($tenNewestPosts as $item) {
				$post_id = $item['p']['id'];
				$sql_show_comment = "SELECT c.id, u.id, u.name, c.post_id, c.time, c.content
						FROM comments c, users u
						WHERE c.post_id = $post_id
						AND c.user_id = u.id
						ORDER BY c.id;";
				$commentOf10Post["$post_id"] = $this->Post->query($sql_show_comment);
			}
			$this->set("commentOf10Post", $commentOf10Post);
		}

		function demo(){}

		function add_post() {
			// event when post something
			if(isset($_POST['btn_writePost'])) {
				$content = $_POST['txt_writePost'];

				$sharpTokens = explode("#", $content);	//1 mảng chứa các chuỗi con phân cách nhau bởi dấu #

				$content = htmlentities($content);		//escape HTML tags as HTML entities?
				$content = nl2br($content);				//convert newline to <br/>
				$content = addcslashes($content, "'");	//add slash before single quote

				$specialChars = array(".", ",", "'", "\"", ";", " ", "(", ")", "!", "@", "$", "%", "^", "&", "*", "+", "=");
				// we should enumerate all the special characters, but I'm so lazy, so stop here
				// Note: this array doesn't contain: - and _
				$tags = "";
				$tagMap = array();

				for ($i=1; $i < count($sharpTokens); $i++) { 		//remove first element, because it not starts with #, or it is a space charater
					$token = $sharpTokens[$i];
					for ($j=0; $j < count($specialChars); $j++) { 
						$pos = strpos($token, $specialChars[$j]);
						if($pos > 0) $token = substr($token, 0, $pos);
					}
					$token = trim($token);
					//$tags .= $token.",";
					if($token != "") $tagMap[$token] = $token;	// cho vào 1 map để tránh việc trùng hashtag
				}

				foreach ($tagMap as $key => $value) {
					$tags .= $value.",";
				}
				
				//insert this post into DB
				$sql_write_post = "INSERT INTO posts(user_id, content, hashtag) VALUES('".$_SESSION['userId']."', '".$content."', '".$tags."')";
				$this->Post->query($sql_write_post);
				$this->set("postSuccess", "1");

				//unsset biến amountOfPages để tính lại tổng số trang chứa tất cả các bài post
				unset($_SESSION['amountOfPages']);
			} else {
				$this->set("errorString", "Error! This page doesn't exist!");
			}
		}

		// function add_comment() {
		// 	// event when add a comment on a post
		// 	if(isset($_POST['comment_post_id'])) {
		// 		$post_id = $_POST['comment_post_id'];
		// 		$cmt_content = $_POST['comment_box_'.$post_id];
		// 		$this->insertComment($post_id, $cmt_content);
		// 	}
		// }

		function insertComment($post_id, $cmt_content) {
			//$_SESSION['isServerProcessing'] = 0;
			//if($_SESSION['isServerProcessing'] == 0) {
			//	$_SESSION['isServerProcessing'] = 1;

				$sql_add_comment = "INSERT INTO comments(user_id, post_id, content) VALUES ('".$_SESSION['userId']."', '".$post_id."', '".$cmt_content."');";
				$this->Post->query($sql_add_comment);
			//}
		}

		function permalink() {
			if(isset($_GET['postId'])) {
				if(is_numeric($_GET['postId'])) {
					$postId = $_GET['postId'];
					$sql_get_posts = "SELECT p.id, u.id, u.name, p.content, p.time, p.hashtag, p.num_of_comments
									FROM posts p, users u
									where p.user_id = u.id
									AND p.id = ".$postId;

					$post = $this->Post->query($sql_get_posts);
					if(count($post) == 0) {
						// no post in DB
						$this->set("postRemoved", "This post has been removed or could not be loaded!");
						return;
					} else {
						$sql_get_comment = "SELECT c.id, u.id, u.name, c.post_id, c.time, c.content
											FROM comments c, users u
											WHERE c.post_id = $postId
											AND c.user_id = u.id
											ORDER BY c.id;";
						$comments = $this->Post->query($sql_get_comment);

						$this->set("post", $post);
						$this->set("comments", $comments);
					}
				} else {
					// no posts to show
					$this->set("errorPostId", "Error! This post doesn't exist!");
					return;
				}
			} else {
				// no posts to show, because user doesn't enter postId in URL
				$this->set("noPosts", "No posts to show!");
				return;
			}
		}

		function search() {
			if(isset($_GET['btn_search'])) {
				$txtSearch = $_GET['txt_search'];
				$sql_search_posts = "SELECT p.id, u.name, p.content
									FROM posts p, users u
									WHERE p.user_id = u.id
									AND p.content LIKE '%".$txtSearch."%';";
				$posts = $this->Post->query($sql_search_posts);
				if(count($posts) == 0) {
					$this->set("noPost", 1);
				} else {
					$this->set("posts", $posts);
				}
			}
		}

		function noJS() {

		}

		function startsWith($haystack, $needle) {
			$len = strlen($needle);
			return substr($haystack, 0, $len) === $needle;
		}

		function tagged() {
			$actual_link_of_file = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			// Nếu viết đầy đủ:
			// $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			// Nhưng web này xài http, ko phải https, nên xài:
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$posOfQuery = strpos($actual_link, "tagged") + 7;	// vì xâu "tagged/" có 7 ký tự
			$tag = substr($actual_link, $posOfQuery);

			if(strlen($tag) > 0) {
				$sql_search_by_tag = "SELECT p.id, u.name, p.content
									FROM posts p, users u
									WHERE p.user_id = u.id
									AND p.hashtag LIKE '%".$tag."%';";
				$posts = $this->Post->query($sql_search_by_tag);
				if(count($posts) == 0) {
					$this->set("noPost", 1);
				} else {
					$this->set("posts", $posts);
				}
			}
		}
	}