<?php require("./check_login_and_forbit_student.php") ?>
<?php //echo $this->Html->css('my_cake.generic.css'); ?>
<?php //echo $this->Html->css('myproject3.css'); ?>
<?php require('./DateUtils.php') ?>
<?php require('./TaskUtils.php') ?>

<?php
	if(!isset($finishedTasks)) return;

	//$json = json_encode($finishedTasks);
	//print_r($json);

	$tableRow = array();

	for ($i=0; $i < count($finishedTasks); $i++) { 
		$taskName = $finishedTasks[$i]['t']['taskName'];
		$startDate = strtotime($finishedTasks[$i]['t']['start']);
		$deadline = strtotime($finishedTasks[$i]['t']['deadline']);
		$process = $finishedTasks[$i]['t']['process'];
		$lastUpdate = myFriendlyDate($finishedTasks[$i]['t']['last_update']);

		$timeInfo = getTimeInfo($startDate, $deadline, $process);

		$tableRow[$i] = getTd($taskName, $startDate, $deadline, $timeInfo['total_time'],
		 	$timeInfo['time_left'], $timeInfo['time_left_percent'], $process, $lastUpdate);
	}
	
	print_r(json_encode($tableRow));
?>