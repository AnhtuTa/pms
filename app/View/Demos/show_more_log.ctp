<?php require("./check_login_and_forbit_student.php") ?>
<?php //echo $this->Html->css('my_cake.generic.css'); ?>
<?php //echo $this->Html->css('myproject3.css'); ?>
<?php require('./DateUtils.php') ?>

<?php
	if(!isset($logTask)) return;

	$result = array();

	for ($i=0; $i < count($logTask); $i++) {
		$userName = $logTask[$i]['u']['user_name'];
		$activity = $logTask[$i]['l']['activity'];
		$taskName = $logTask[$i]['l']['task_name'];
		$time = myFriendlyDate($logTask[$i]['l']['time']);
		$field = $logTask[$i]['l']['field'];
		$oldValue = $logTask[$i]['l']['old_value'];
		$newValue = $logTask[$i]['l']['new_value'];
		
		$userName = "<span class='log_user_name'><b>$userName</b></span>";
		$field = "<span class='log_field'>$field</span>";
		$oldValue = "<span>$oldValue</span>";
		$newValue = "<span class='log_new_value'>$newValue</span>";
		$taskName = "<span class='log_task_name'><i>$taskName</i></span>";

		//echo "<tr>\n";
		//echo "<td>$time</td>\n";
		$result[$i]['time'] = $time;
		switch ($activity) {
			case 'add':
				$result[$i]['activity'] = "add";
				$result[$i]['activity_content'] = "$userName has added a new task: $taskName";
				break;
			case 'update':
				$result[$i]['activity'] = "update";
				$result[$i]['activity_content'] = "$userName has updated $field of task: $taskName";
				$result[$i]['activity_content'] .= "<div>Old $field: $oldValue</div>";
				$result[$i]['activity_content'] .= "<div>New $field: $newValue</div>";
				break;
			case 'delete':
				$result[$i]['activity'] = "delete";
				$result[$i]['activity_content'] = "$userName has deleted a task: $taskName";
				break;

			default:
				$result[$i]['activity'] = "unknown";
				$result[$i]['activity_content'] = "[show_more_log.ctp] Error: unknown activity!";
				break;
		}
		//echo $result[$i]['activity']."\n";

		//echo "</tr>\n";
	}

	print_r(json_encode($result));
?>