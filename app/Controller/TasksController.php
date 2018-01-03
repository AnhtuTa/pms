<?php session_start(); ?>
<?php
class TasksController extends AppController{
	public $name = "Tasks";
	var $LIMIT_LOG = 10;

	//================ old versions ============================//
	function show_all_task() {
		$sql = "SELECT * FROM tasks ORDER BY user_id, start DESC";

  		$allTasks = $this->Task->find("all");
		$this->set("allTasks", $allTasks);
	}

	function show_all_task_2() {
		$sql = "SELECT * FROM tasks ORDER BY start";

    	$allTasks = $this->Task->query($sql);
		$this->set("allTasks", $allTasks);
		var_dump($allTasks);
	}

	function show_all_tasks_oldVersion3() {
		$sql = "SELECT t.id, t.name AS taskName, u.name AS personInCharge, t.start, t.deadline, t.process, t.last_update
				FROM tasks t, users u
				WHERE t.user_id = u.id
				ORDER BY t.user_id, t.start DESC";

    	$allTasks = $this->Task->query($sql);
		$this->set("allTasks", $allTasks);
		//var_dump($allTasks);
	}
	//================ old versions ============================//

	function index() {}

	function add_task() {
		if(isset($_POST['btn_save'])) {
			$na = $_POST['txt_taskName'];
			$st = $_POST['txt_start'];
			$dl = $_POST['txt_deadline'];
			$pr = $_POST['txt_process'];

			// insert to DB, using save(), this method is available in Cakephp
			$this->Task->set(array(
					'user_id' => $_SESSION['userId'],
					'name' => $na,
					'start' => $st,
					'deadline' => $dl,
					'process' => $pr
				)
			);
			$this->Task->save();
			//echo $this->Task->getInsertID();		// trả về id của comment vừa đc insert vào DB

			// header("Location: http://$_SERVER[HTTP_HOST]"."/project3/tasks/my_tasks");
			// die();
			echo "<script type='text/javascript'>
					var STR_MY_WEBSITE = location.protocol + '//' + location.hostname + (location.port ? (':' + location.port) : '') + '/project3';
					window.location = STR_MY_WEBSITE + '/tasks/my_tasks';
				</script>";
			die();
			return;
		}
	}

	function show_all_tasks() {
		$sql = "SELECT t.id, t.name AS taskName, u.id, u.name AS personInCharge, t.start, t.deadline, t.process, t.last_update
				FROM tasks t, users u
				WHERE t.user_id = u.id
				AND t.process < 100
				ORDER BY t.user_id, t.start DESC";

    	$allTasks = $this->Task->query($sql);
		$this->set("allTasks", $allTasks);
	}

	function my_tasks() {
		//echo "userId = ".$_SESSION['userId'];
		if(!isset($_SESSION['userId'])) return;

		$sql = "SELECT t.id, t.name AS taskName, u.name AS personInCharge, t.start, t.deadline, t.process, t.last_update
				FROM tasks t, users u
				WHERE t.user_id = u.id
				AND u.id = '".$_SESSION['userId']."' ORDER BY t.start DESC";

    	$allTasks = $this->Task->query($sql);
		$this->set("allTasks", $allTasks);
		//var_dump($allTasks);
	}

	function edit_task() {
		if(isset($_POST['btn_save'])) {
			$na = $_POST['txt_taskName'];
			$st = $_POST['txt_start'];
			$dl = $_POST['txt_deadline'];
			$pr = $_POST['txt_process'];
			$id = $_POST['taskId'];

			//update data to DB
			$sql = "UPDATE tasks t 
					SET name = '".$na."', start = '".$st."', deadline = '".$dl."', process = '".$pr."' WHERE id = ".$id." AND t.user_id = '".$_SESSION['userId']."'";
			$kq = $this->Task->query($sql);

			//send data to view (edit_task.ctp)
			$this->set("taskName", $na);
	    	$this->set("start", $st);
	    	$this->set("deadline", $dl);
	    	$this->set("process", $pr);
	    	$this->set("taskId", $id);
			$this->set("infoString", "Saved! Click <a href='my_tasks'>here</a> to return your tasks<br>");

			$_SESSION['editTaskStatus'] = 1;
			// header("Location: http://$_SERVER[HTTP_HOST]"."/project3/tasks/my_tasks");
			// die();

			echo "<script type='text/javascript'>
					var STR_MY_WEBSITE = location.protocol + '//' + location.hostname + (location.port ? (':' + location.port) : '') + '/project3';
					window.location = STR_MY_WEBSITE + '/tasks/my_tasks';
				</script>";
			die();
			return;
		}
		//echo $_SESSION['userId'];
		$sql = "SELECT t.id, t.name AS taskName, t.start, t.deadline, t.process
				FROM tasks t
				WHERE t.id = ".$_GET['taskId']." AND t.user_id = '".$_SESSION['userId']."'";
		// tại sao phải thêm "t.user_id = ..." vào điều kiện WHERE ở trên?
		// vì để tránh trường hợp SV này có thể sửa task của SV khác
    	$task_for_edit = $this->Task->query($sql);

    	// Nếu ko tồn tại $task_for_edit[0]['t']['taskName'] nghĩa là ko lấy đc record nào từ DB
    	if(!isset($task_for_edit[0]['t']['taskName'])) {
    		$this->set("errorString", "This task's ID is invalid!");
    		return;
    	}
    	// In thằng này ra sẽ hiểu:
    	//print_r($task_for_edit);

		//send data to view (edit_task.ctp)
    	$this->set("taskName", $task_for_edit[0]['t']['taskName']);
    	$this->set("start", $task_for_edit[0]['t']['start']);
    	$this->set("deadline", $task_for_edit[0]['t']['deadline']);
    	$this->set("process", $task_for_edit[0]['t']['process']);
    	$this->set("taskId", $task_for_edit[0]['t']['id']);
	}

	function student_log() {
		$sql_log = "SELECT u.name AS user_name, l.time, l.activity, l.task_name, l.field, l.old_value, l.new_value
					FROM log_task l, users u
					where l.user_id = u.id
					order by l.id DESC
					limit 0, $this->LIMIT_LOG";
		$logTask = $this->Task->query($sql_log);
		$this->set("logTask", $logTask);
	}

	// function show_more_log() {
	// 	// start = start index, amount = amount of row wants to return
	// 	// sql clause would be: LIMIT $start, $amount
	// 	//if(isset($_GET['start']) && isset($_GET['amount'])) {
	// 	// $start = $_GET['start'];
	// 	// $amount = $_GET['amount'];
	// 	echo "OK<br>";
	// 	// echo "$start<br>";
	// 	// echo "$amount<br>";

	// 	$sql = "SELECT u.name AS user_name, l.time, l.activity, t.name AS task_name, l.field, l.old_value, l.new_value
	// 			FROM log_task l, users u, tasks t
	// 			where l.user_id = u.id
	// 			and l.task_id = t.id
	// 			order by l.id DESC
	// 			limit 0, 11";

	// 	$logTask = $this->Task->query($sql);
	// 	print_r($logTask);
	// 	$this->set("logTask", $logTask);
	// }
}
