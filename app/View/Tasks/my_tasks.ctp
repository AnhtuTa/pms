<?php require("./check_login_and_forbit_teacher.php") ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('task.css'); ?>
<?php require('./menu.php') ?>
<?php require('./TaskUtils.php') ?>
<?php require('./DateUtils.php') ?>

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
<table>
	<!-- <tr>
		<td class="table_header">Task name</td>
		<td class="table_header">Start date</td>
		<td class="table_header">Deadline</td>
		<td class="table_header">Process</td>
		<td></td>
	</tr> -->
	<?php
		// foreach ($allTasks as $item) {
		// 	$taskId = $item['t']['id'];
		// 	echo "<tr>\n";
		// 	echo "\t<td>".$item['t']['taskName']."</td>\n";
		// 	echo "\t<td>".$item['u']['personInCharge']."</td>\n";
		// 	echo "\t<td>".date("d/m/Y", strtotime($item['t']['start']))."</td>\n";
		// 	echo "\t<td>".date("d/m/Y", strtotime($item['t']['deadline']))."</td>\n";
		// 	echo "\t<td>".$item['t']['process']."</td>\n";
		// 	echo "\t<td><span class='btn_edit_task'><a href='edit_task?taskId=".$taskId."'>Edit</a></span></td>\n";
		// 	echo "</tr>\n";
		// }

		echo "<table class='task_table'>\n";
		echo getTh();	// Có thể thêm tham số cho hàm này, chẳng hạn: getTh("them 1 td o day!");

		for ($i=0; $i < count($allTasks); $i++) {
			$taskId = $allTasks[$i]['t']['id'];
			$taskName = $allTasks[$i]['t']['taskName'];
			$startDate = strtotime($allTasks[$i]['t']['start']);
			$deadline = strtotime($allTasks[$i]['t']['deadline']);
			$process = $allTasks[$i]['t']['process'];
			$lastUpdate = myFriendlyDate($allTasks[$i]['t']['last_update']);

			$timeInfo = getTimeInfo($startDate, $deadline, $process);

			echo getTr($taskName, $startDate, $deadline, $timeInfo['total_time'],
				$timeInfo['time_left'], $timeInfo['time_left_percent'], $process, $lastUpdate, $taskId);
		}
		echo "</table>\n";
	?>
</table>