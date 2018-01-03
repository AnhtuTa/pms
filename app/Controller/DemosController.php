<?php session_start(); ?>
<?php
class DemosController extends AppController {
	public $name = "Demos";
	
	//============ Các hàm sau chỉ để phục vụ cho các hàm khác, chứ ko gọi đến view để hiển thị===============//
	public function beforeRender() {
	    parent::beforeRender();
	    $this->layout = 'empty';
	}

	function insertComment($post_id, $cmt_content) {
		$sql_add_comment = "INSERT INTO comments(user_id, post_id, c
			ontent) VALUES ('".$_SESSION['userId']."', '".$post_id."', '".$cmt_content."');";
		$kq = $this->Demo->query($sql_add_comment);
		$this->Demo->save();
		echo "cmtId = ".$this->Demo->getInsertID()."<br>";
		echo "cmtId = ".$this->Demo->getLastInsertID()."<br>";
		echo "cmtId = ".$this->Demo->id."<br>";
	}

	//=========================================================================================================//

	//======= Các hàm sau gọi tới view, nghĩa là thư mục view phải có 1 file tương ứng với tên của hàm ==============//
	function index() {
		echo "<h3 style='text-align: center; font-size: 100px; color: red;'>fuck Cakephp!!!</h3>";
	}

	function show_more_log() {
		// start = start index, amount = amount of row wants to return
		// sql clause would be: LIMIT $start, $amount
		if(isset($_GET['start']) && isset($_GET['amount'])) {
			$start = $_GET['start'];
			$amount = $_GET['amount'];

			$sql = "SELECT u.name AS user_name, l.time, l.activity, l.task_name, l.field, l.old_value, l.new_value
					FROM log_task l, users u, tasks t
					where l.user_id = u.id
					and l.task_id = t.id
					order by l.id DESC
					limit $start, $amount";

			$logTask = $this->Demo->query($sql);
			$this->set("logTask", $logTask);
		}
	}

	function show_finished_tasks() {
		if(isset($_GET['userId'])) {
			$sql = "SELECT t.id, t.name AS taskName, t.start, t.deadline, t.process, t.last_update
					FROM tasks t
					WHERE t.user_id = '".$_GET['userId']."'
					AND t.process = 100
					ORDER BY t.start DESC";
			$finishedTasks = $this->Demo->query($sql);
			$this->set("finishedTasks", $finishedTasks);
			//print_r($finishedTasks);
		}
		
	}

	// add a comment using JSONP, not AJAX
	function add_comment_jsonp() {
		if(isset($_GET['postId'])) {
			$post_id = $_GET['postId'];
			$cmt_content = $_GET['content'];
			$this->insertComment($post_id, $cmt_content);
		}
	}

	function delete_comment_jsonp() {
		if(isset($_GET['cmtId'])) {
			$sql_delete = "DELETE FROM comments WHERE id = ".$_GET['cmtId'];
			$this->Demo->query($sql_delete);
		}
	}

	function delete_post() {
		if(isset($_POST['postId'])) {
			$sql_delete = "DELETE FROM posts WHERE id = ".$_POST['postId'];
			$this->Demo->query($sql_delete);
			$this->set("deletedPostId", $_POST['postId']);
		} else {
			echo "<h2 style='color: red'>[DemosController] Error: you must send params using POST method!</h2>";
		}

		//unsset biến amountOfPages để tính lại tổng số trang chứa tất cả các bài post
		if(isset($_SESSION['amountOfPages'])) unset($_SESSION['amountOfPages']);
	}

	function delete_task() {
		if(isset($_POST['taskId'])) {
			$sql_delete = "DELETE FROM tasks WHERE id = ".$_POST['taskId'];
			$this->Demo->query($sql_delete);

			//unsset biến amountOfPages để tính lại tổng số trang chứa tất cả các bài post
			unset($_SESSION['amountOfPages']);
		} else {
			echo "<h2 style='color: red'>[DemosController] Error: you must send params using POST method!</h2>";
		}
	}
}