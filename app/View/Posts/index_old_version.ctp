<?php require('./check_login.php') ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('forum.css'); ?>
<?php require('./menu.php') ?>
<?php require('./DateUtils.php') ?>
<?php echo $this->Html->script('jquery-3.2.1.min.js'); ?>

<script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>:8000/socket.io/socket.io.js"></script>

<?php echo $this->Html->script('forum.js');?>
<?php echo $this->Html->script('sweetalert.min.js');?>
<?php
	$STR_SHOW_CMT = "Show comments";
	$STR_HIDE_CMT = "Hide comments";
	$STR_SO_TYPING = "Someone is typing...";
	$MY_WEBSITE = "http://$_SERVER[HTTP_HOST]"."/project3";
?>

<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

<div class="page_wrapper">
	<div class="write_post_wrapper">
		<h3>Post something in forum</h3>
		<form method="post" action="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/posts/add_post" ?>">
			<div class="write_post_inner_wrapper">
				<textarea class="write_post_box" name="txt_writePost" placeholder="what the heck do you want to ask..." onkeyup="writePostKeyUp(this)"></textarea>
				<input class="normal_btn btn_save write_post_btn" id="write_post_btn_id" type="submit" value="Post" disabled="disabled" name="btn_writePost">
			</div>
		</form>
	</div>
	<div id="info_after_post_id" class="info_after_post"><?php if(isset($infoString)) echo $infoString; ?></div>
	<div style="margin-bottom: 40px;"></div>
	<?php 
		foreach ($tenNewestPosts as $item) {
			$post_id = $item['p']['id'];
			$post_poster = $item['u']['name'];
			$post_content = $item['p']['content'];
			$post_time = $item['p']['time'];
			$post_hashtag = $item['p']['hashtag'];

			$cmt_box = "comment_box_".$post_id;		//VD: format: txt_comment_12 nghĩa là người dùng đang đăng nhập comment ở post có id = 12
			$cmt_btn = "comment_btn_".$post_id;
			$cmt_div_show_hide_cmt_id = "comment_div_show_hide_".$post_id."_id";
			$cmt_a_show_hide_cmt_id = "comment_a_show_hide_".$post_id."_id";
			$cmt_div_all_cmt_id = "comment_all_comments_".$post_id."_id";
			?>
	<div class="post_wrapper">
		<div class="post_body">
			<div class="post_poster"><?php echo $post_poster; ?></div>
			<div class="post_time"><?php echo myFormatDate(strtotime($post_time)); ?></div>
			<div class="post_content"><?php echo $post_content; ?></div>
		</div>
		<div class="comment_body">
			
			<div class="comment_show_hide_comments" id="<?php echo $cmt_div_show_hide_cmt_id ?>" style=""><a href="javascript:void(0)" onclick="showHideComments(this)"
				id="<?php echo $cmt_a_show_hide_cmt_id ?>" postId="<?php echo $post_id ?>"><?php echo $STR_SHOW_CMT ?></a></div>
			
			<div class="comment_all_comments" id="<?php echo $cmt_div_all_cmt_id ?>" style="display: none;">
				<?php
					if(count($commentOf10Post[$post_id]) == 0) {
						echo 
							'<script type="text/javascript">
								document.getElementById("'.$cmt_div_show_hide_cmt_id.'").style.display = "none";
							</script>';
					}
					foreach ($commentOf10Post[$post_id] as $comment) {
						$cmt_id = $comment['c']['id'];
						$comment_content = $comment['c']['content'];
						$comment_time = $comment['c']['time'];
						$comment_commentorId = $comment['u']['id'];
						$comment_commentor =  $comment['u']['name'];
						$cmt_each_cmt_id = "comment_each_cmt_id_".$cmt_id;
						$cmt_tooltip_id = "cmt_tooltip_id_".$cmt_id;
					?>
				<div class="comment_each_comment" id="<?php echo $cmt_each_cmt_id ?>">
					<div class="cmt_tooltip" id="<?php echo $cmt_tooltip_id ?>"></div>
					
					<div class="comment_commentor">
						<?php echo $comment_commentor; ?>
						
						<?php if ($comment_commentorId == $_SESSION['userId']) { ?>
						
						<span class="cmt_dropdown">
							<div class="cmt_drop_btn">...</div>
							
							<div class="cmt_dropdown_content">
								<span class="a_tag" onclick="editComment(this)" cmtId="<?php echo $cmt_id ?>" 
									onmouseover="mouseOverEdit(<?php echo $cmt_id ?>)" 
									onmouseout="mouseOutED(<?php echo $cmt_id ?>)">Edit</span>
								
								<span class="a_tag" onclick="deleteComment(<?php echo $cmt_id ?>)" cmtId="<?php echo $cmt_id ?>" 
									onmouseover="mouseOverDelete(<?php echo $cmt_id ?>)" 
									onmouseout="mouseOutED(<?php echo $cmt_id ?>)">Delete</span>
							</div>
						</span>
						<div style="clear: both;"></div>

						<?php } ?>
					</div>
					<div class="comment_time"><?php echo myFormatDate(strtotime($comment_time)); ?></div>
					<div class="comment_content"><?php echo $comment_content; ?></div>
				</div>
					<?php
					}
				?>
			</div>

			<!-- <div id="<?php //echo "loading_icon_id_".$post_id ?>" class="lds-rolling-20 loading_icon" style="display: none;">
				<div></div>
			</div> -->

			<div id="<?php echo "loading_icon_id_".$post_id ?>"></div>	<!-- insert loading icon here when we need! -->

			<div class="comment_write_comment">
				<div class="someone_typing" id="<?php echo "someone_typing_id_".$post_id ?>" style="display: none">
					<img src="<?php echo $MY_WEBSITE."/img/typing35.gif" ?>" width='40' style="border-radius: 18px;"> <span class="txt_so_typing"><?php echo $STR_SO_TYPING ?></span>
				</div>
				<div class="write_cmt_wrapper">
					<textarea class="comment_box" onkeyup="cmtBoxKeyUp(this)" postId="<?php echo $post_id ?>" onfocus="cmtBoxOnFocus(this)" onfocusout="cmtBoxOnFocusOut(this)"
						name="<?php echo $cmt_box; ?>" id="<?php echo $cmt_box."_id"; ?>" placeholder="write a comment..."></textarea>
					<input class="normal_btn btn_save comment_btn" type="submit" name="<?php echo $cmt_btn; ?>"value="Comment"
						disabled="disabled" id="<?php echo $cmt_btn."_id" ?>" postId="<?php echo $post_id ?>"
						onclick="btnCommentEvent_AJAX(this)" />
				</div>
			</div>
		</div>
	</div>
			<?php
		}

		if(isset($errorPageNumber)) {
			echo "<div style='color: red;'>$errorPageNumber</div>";
		}
	?>
</div>

<div class="page_list">
	<?php
		if(isset($currentPage)) {
			if($currentPage > 1) {
				echo "<a href='http://$_SERVER[HTTP_HOST]/project3/posts?page=".($currentPage - 1)."'><< Previous</a> ";
			}

			$eid = $_SESSION['amountOfPages'];
			for ($i=1; $i < $eid; $i++) {
				if($i == $currentPage) echo "<b>$i</b> ";
				else echo "<a href='http://$_SERVER[HTTP_HOST]/project3/posts?page=".$i."'>".$i."</a> ";
			}

			if($eid == $currentPage) echo "<b>$eid</b> ";
			else echo "<a href='http://$_SERVER[HTTP_HOST]/project3/posts?page=".$eid."'>".$eid."</a> ";

			if($currentPage < $eid) {
				echo "<a href='http://$_SERVER[HTTP_HOST]/project3/posts?page=".($currentPage + 1)."'>Next >></a> ";
			}
		}
	?>
</div>
<script type="text/javascript">
	//=============== socket ============================//
	var socket = io("http://localhost:8000/");
	socket.emit("logined_user", "<?php echo $_SESSION['userId'] ?>");
	socket.on("message", function(data) {
	    console.log("data from server: " + data);
	});

	socket.on("someone_comments", function(data) {
		console.log(data);
		insertComment(data, -1);
	});

	socket.on("someone_is_typing", function(postId) {
		console.log("There are someone is typing in postId = " + postId);
		document.getElementById("someone_typing_id_" + postId).style.display = '';
	});

	socket.on("noone_is_typing", function(postId) {
		console.log("There's no body is typing in postId = " + postId);
		document.getElementById("someone_typing_id_" + postId).style.display = 'none';
	});

	
	//=============== end of socket ============================//
	function btnCommentEvent_AJAX(element) {
		var postId = element.getAttribute("postId");
		showLoadingIcon(postId);

		// trim and replace all line breaks in a string with <br /> tags?
		var content = document.getElementById("comment_box_" + postId + "_id").value.trim().replace(/(?:\r\n|\r|\n)/g, '<br />');

		document.getElementById("comment_box_" + postId + "_id").value = "";	//delete comment box
		document.getElementById("comment_btn_" + postId + "_id").setAttribute("disabled", "disabled");	//disable button comment

		sendCommentToServer(postId, content);
		hideLoadingIcon(postId);
		sendCommentToNodeJS(postId, content);
		cmtBoxOnFocusOut(element);
	}

	function sendCommentToServer(postId, content) {
		contentSendToServer = content.replace(/'/g, '\\\'');	// replace all ' to \'

		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();	// code for modern browsers
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	// code for old IE browsers
		}

		xmlhttp.onreadystatechange = function() {
			if(this.readyState == 4 && this.status == 200) {
				console.log("Bạns vừa comment! ID của comment này là: " + this.responseText);
				displayComment(postId, content, this.responseText);
			}
		}

		xmlhttp.open("POST", "<?php echo $MY_WEBSITE ?>/comments/add_comment_jsonp");
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("postId=" + postId + "&content=" + contentSendToServer);
	}

	function displayComment(postId, content, cmtId) {
		console.log("[function displayComment] cmtId = " + cmtId);
		var json_str = {
			"postId": postId,
			"commentor": "<?php echo $_SESSION['userName'] ?>",
			"time": "<?php echo myFormatDate(strtotime(date('Y-m-d H:i:s'))) ?>",
			"content": content
		}

		// display comment ở giao diện người dùng
		insertComment(json_str, cmtId);
	}

	/**
	* Hàm này gửi nội dung comment tới NodeJS, để nó thông báo tới các user khác biết
	* rằng thằng này vừa comment, để các browser của các user khác hiển thị comment đó
	* format của data gửi đi giống hệt json_str trong hàm displayComment
	**/
	function sendCommentToNodeJS(postId, content) {
		socket.emit("client_comments", {
			postId: postId,
			commentor: "<?php echo $_SESSION['userName'] ?>",
			"time": "<?php echo myFormatDate(strtotime(date('Y-m-d H:i:s'))) ?>",
			content: content
		});
	}

	function cmtBoxOnFocus(element) {
		var postId = element.getAttribute("postId");
		socket.emit("client_typing", postId);
	}

	function cmtBoxOnFocusOut(element) {
		var postId = element.getAttribute("postId");
		socket.emit("client_stop_typing", postId);
	}
</script>

<?php //echo "time now = ".date("Y-m-d H:i:s")."<br>" ?>
<?php
	//echo myFormatDate(strtotime(date('Y-m-d H:i:s')))."<br>";
	//echo strtotime(date('Y-m-d H:i:s'))."<br>";
?>

