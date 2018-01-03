<?php require("./check_login_and_forbit_student.php") ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('task.css'); ?>
<?php require('./menu.php') ?>

<style type="text/css">
	
</style>
<h3>These are all students in our lab and their tasks</h3>
<?php
	if($allTasks == null) {
		echo "Data empty!";
	} else {
		$i = 0;
		while ($i < count($allTasks)) {
			$currPerson = $allTasks[$i]['u']['personInCharge'];
			echo "<h4 class='task_pic'><a href='javascript:void(0)' onclick=''>".$currPerson."</a></h4>";
			echo "<div class='task_each_student_'".$currPerson.">";
			
			while (isset($allTasks[$i]) && $currPerson == $allTasks[$i]['u']['personInCharge']) {
				$startDate = $allTasks[$i]['t']['start'];
				$deadline = $allTasks[$i]['t']['deadline'];
				$totalTime = (strtotime($deadline) - strtotime($startDate))/24/3600;
				$timePass = (time() - strtotime($startDate))/24/3600;	//số ngày đã trôi qua tính từ startDate
				if($timePass > $totalTime) {
					$timePass = "overtime!";
					$timePass_percent = 100;
				} else {
					$timePass = round($timePass);
					$timePass_percent = round($timePass*100/$totalTime);
				}
				
				$process = $allTasks[$i]['t']['process'];

				echo "<div class='white_bg'><a style='color: #1a5fce' href='javascript:void(0)' onclick=''>".$allTasks[$i]['t']['taskName']."</a></div>";
				echo "<div class='gray_bg'>Start date: ".$startDate."</div>";
				echo "<div class='white_bg'>Deadline: ".$deadline."</div>";
				echo "<div class='gray_bg'>";
				echo "<div>Time pass: ".$timePass; echo is_numeric($timePass) ? ($timePass > 1 ? " days" : " day") : ""; echo "</div>";;
					echo "<div style='border: 1px solid #f4427a; height: 12px; margin-top: 5px;'>";
					echo "<div style='background: #f4427a; width: ".$timePass_percent."%; height: 12px;'></div>";
				echo "</div></div>";

				echo "<div class='white_bg'><div>Process: ".$process."%</div>";
				echo "<div style='border: 1px solid #f4427a; height: 12px; margin-top: 5px;'>
					<div style='background: #f4427a; width: ".$process."%; height: 12px;'></div>
				</div></div>";
				$i++;
			}
			echo "</div>";
		}
	}
?>