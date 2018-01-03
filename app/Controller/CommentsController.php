<?php session_start(); ?>
<?php
class CommentsController extends AppController {
	public $name = "Comments";
	
	//============ Các hàm sau chỉ để phục vụ cho các hàm khác, chứ ko gọi đến view để hiển thị===============//
	public function beforeRender() {
	    parent::beforeRender();
	    $this->layout = 'empty';
	}

	// CẤM KHÔNG echo CÁI GÌ TRONG HÀM NÀY, CHỈ echo getInsertID()
	// deploy trên 000webhost.com ko dùng đc hàm này!!!
	function insertComment($post_id, $cmt_content) {
		$this->Comment->set(array(
				'user_id' => $_SESSION['userId'],
				'post_id' => $post_id,
				'content' => $cmt_content
			)
		);
		$this->Comment->save();
		echo $this->Comment->getInsertID();		// trả về id của comment vừa đc insert vào DB
		// echo "cmtId = ".$this->Comment->getInsertID()."<br>";
		// echo "cmtId = ".$this->Comment->getLastInsertID()."<br>";
		// echo "cmtId = ".$this->Comment->id."<br>";
	}

	// CẤM KHÔNG echo CÁI GÌ TRONG HÀM NÀY, CHỈ echo getInsertID()
	// Do 000webhost.com ko dùng đc insertComment() nên xài cái này
	function insertComment_2($post_id, $cmt_content) {
		// Create connection
		$conn = new mysqli($this->SERVER_NAME, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "INSERT INTO comments (user_id, post_id, content)
		VALUES ('".$_SESSION['userId']."', '".$post_id."', '".$cmt_content."')";

		if ($conn->query($sql) === TRUE) {
		    $last_id = $conn->insert_id;
		    echo $last_id;
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}

	//=========================================================================================================//

	//======= Các hàm sau gọi tới view, nghĩa là thư mục view phải có 1 file tương ứng với tên của hàm ==============//
	function index() {
		echo "<h3 style='text-align: center; font-size: 100px; color: red;'>fuck Cakephp!!!</h3>";
	}

	// add a comment using JSONP, not AJAX
	function add_comment_jsonp() {
		if(isset($_POST['postId'])) {
			$post_id = $_POST['postId'];
			$cmt_content = $_POST['content'];
			$this->insertComment_2($post_id, $cmt_content);
		} else {
			echo "<h2 style='color: red'>[CommentsController] Error: you must send params using POST method!</h2>";
		}
	}
}