<?php require("./check_login_and_forbit_student.php") ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('task.css'); ?>
<?php require('./menu.php') ?>
<?php require('./DateUtils.php') ?>
<?php require('./TaskUtils.php') ?>
<?php echo $this->Html->script('task.js');?>

<title>Student tasks</title>

<h3>These are all students in our lab and their tasks</h3>
<?php
	if($allTasks == null) {
		echo "Data empty!";
	} else {
		$i = 0;
		while ($i < count($allTasks)) {
			$userName = $allTasks[$i]['u']['personInCharge'];
			$userId = $allTasks[$i]['u']['id'];

			// print pic = person in charge
			echo "<h4 class='task_pic_h4'><span userId='$userId' class='task_pic_span' 
				onclick='showHideTable(this)'>".$userName."</span></h4>";
			
			// print table of each person (student)
			echo "<div id='task_table_".$userId."'>";
			echo "<table class='task_table'>\n";
			echo getTh();

			while (isset($allTasks[$i]) && $userId == $allTasks[$i]['u']['id']) {
				$taskName = $allTasks[$i]['t']['taskName'];
				$startDate = strtotime($allTasks[$i]['t']['start']);
				$deadline = strtotime($allTasks[$i]['t']['deadline']);
				$process = $allTasks[$i]['t']['process'];
				$lastUpdate = myFriendlyDate($allTasks[$i]['t']['last_update']);

				$timeInfo = getTimeInfo($startDate, $deadline, $process);

				echo getTr($taskName, $startDate, $deadline, $timeInfo['total_time'],
					$timeInfo['time_left'], $timeInfo['time_left_percent'], $process, $lastUpdate);
				
				$i++;
			}
			echo "</table>\n";
			echo "<div class='task_div_finished'>
					<span class='task_span_finished' userId='".$userId."' onclick='showFinishedTasks(this)'>
						Show finished tasks
					</span></div>";
			?>
				<div id="<?php echo "loading_icon_".$userId ?>" style="width:100%;height:100%; display: none; padding-left: 20px;" class="lds-rolling-20">
					<div></div>
				</div>
			<?php
			echo "</div>";
		}
	}
?>
