<?php require("./check_login_and_forbit_teacher.php") ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('task.css'); ?>
<?php require('./menu.php') ?>
<?php require('./TaskUtils.php') ?>
<?php require('./DateUtils.php') ?>
<?php echo $this->Html->script('task.js');?>

<?php $MY_WEBSITE = "http://$_SERVER[HTTP_HOST]"."/project3" ?>

<?php
	if($allTasks == null) {
		echo "<h3>You haven't created any task yet!</h3>";
		echo "<h4>Click <a href='$MY_WEBSITE"."/tasks/add_task"."'>here</a> to create a new task!</h4>";
		return;
	}
	if(isset($_SESSION['editTaskStatus']) && $_SESSION['editTaskStatus'] == 1) {
		echo "<h4 class='info_string'>Saved!</h4>";
		unset($_SESSION['editTaskStatus']);
	}
?>
<h2>Here are your all tasks</h2>
<table class='task_table' id='table_my_tasks'>
	<?php
		echo getTh("table_my_tasks", false);

		for ($i=0; $i < count($allTasks); $i++) {
			$taskId = $allTasks[$i]['t']['id'];
			$taskName = $allTasks[$i]['t']['taskName'];
			$startDate = strtotime($allTasks[$i]['t']['start']);
			$deadline = strtotime($allTasks[$i]['t']['deadline']);
			$process = $allTasks[$i]['t']['process'];
			$lastUpdate = $allTasks[$i]['t']['last_update'];

			$timeInfo = getTimeInfo($startDate, $deadline, $process);

			echo getTr($taskName, $startDate, $deadline, $timeInfo['total_time'],
				$timeInfo['time_left'], $timeInfo['time_left_percent'], $process, $lastUpdate, $taskId);
		}
	?>
</table>