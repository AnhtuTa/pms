<?php require("./check_login_and_forbit_student.php") ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('task.css'); ?>
<?php require('./menu.php') ?>
<?php require('./DateUtils.php') ?>
<?php echo $this->Html->script('task.js');?>

<title>Student tasks</title>

<h3>These are all students in our lab and their tasks</h3>
<?php
	if($allTasks == null) {
		echo "Data empty!";
	} else {
		$i = 0;
		while ($i < count($allTasks)) {
			$user = $allTasks[$i]['u']['personInCharge'];
			echo "<h4 class='task_pic_h4'><span userId='$user' class='task_pic_span' onclick='showHideTable(this)'>".$user."</span></h4>";	/* pic = person in charge */
			
			echo "<div class='task_each_student_'".$user.">";
			
			echo "<table class='task_table' id='task_table_".$user."' style=''>\n";
			echo "<tr class='table_header'>\n";
			echo "<td>Task name</td>\n";
			echo "<td>Start date</td>\n";
			echo "<td>Deadline</td>\n";
			echo "<td>Time left/Total time</td>\n";
			echo "<td>Process</td>\n";
			echo "<td>Last update</td>\n";
			echo "</tr>\n";

			while (isset($allTasks[$i]) && $user == $allTasks[$i]['u']['personInCharge']) {
				$name = $allTasks[$i]['t']['taskName'];
				$startDate = strtotime($allTasks[$i]['t']['start']);
				$deadline = strtotime($allTasks[$i]['t']['deadline']);
				$process = $allTasks[$i]['t']['process'];
				$lastUpdate = myFriendlyDate($allTasks[$i]['t']['last_update']);

				$totalTime = ($deadline - $startDate)/24/3600;

				$timeLeft = ($deadline - time())/24/3600;	// số ngày còn lại trước khi tới deadline
				if($timeLeft < 0) {
					$timeLeft = $process < 100 ? "<div style='color: red'><b>overtime!</b></div>" : "<div style='color: #1a5fce'><b>finished!</b></div>";
					$timeLeft_percent = 0;
				} else {
					$timeLeft = ceil($timeLeft);
					$timeLeft_percent = round($timeLeft*100/$totalTime);
				}
				if($timeLeft_percent > 100) $timeLeft_percent = 100;	//đề phòng trường hợp startDate < time() (nghĩa là thời điểm start của task này là trong tương lai)
				
				$startDate = date("d/m/Y", $startDate);
				$deadline = date("d/m/Y", $deadline);
				echo "<tr>\n";
				echo "<td class='task_name'>".$name."</td>\n";
				echo "<td>".$startDate."</td>\n";
				echo "<td>".$deadline."</td>\n";
				
				echo "<td class='process_bar'>".$timeLeft;
				echo is_numeric($timeLeft) ? (($timeLeft > 1 ? " days" : " day")."/$totalTime".($totalTime > 1 ? " days" : " day")) : "";
					echo "<div style='border: 1px solid #f4427a; height: 12px; margin: 5px 5% 0 0;'>";
						echo "<div style='background: #f4427a; width: ".(100 - $timeLeft_percent)."%; height: 12px;'></div>";	// thanh này hiển thị số ngày đã qua, như con số ở trên thanh này lại hiển thị số ngày còn lại
				echo "</div></td>\n";

				echo "<td class='process_bar'>".$process."%";
				echo "<div style='border: 1px solid #f4427a; height: 12px; margin: 5px 5% 0 0;'>
						<div style='background: #f4427a; width: ".$process."%; height: 12px;'></div>
					</div></td>\n";

				echo "<td class='task_last_update'>".$lastUpdate."</td>\n";
				echo "</tr>\n";

				$i++;
			}
			echo "</table>\n";
		}
	}
?>