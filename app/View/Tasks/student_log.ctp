<?php require("./check_login_and_forbit_student.php") ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('log.css'); ?>
<?php require('./menu.php') ?>
<?php require('./DateUtils.php') ?>

<title>Student logs</title>

<?php
	echo "<table id='log_table'>\n";
	echo "<tr class='table_header'>\n";
		echo "<td>Time</td>\n";
		echo "<td>Activity</td>\n";
	echo "</tr>\n";
	
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

		$td = "";
		$tr_bg = "";

		switch ($activity) {
			case 'add':
				$td .= "<td>$userName has added a new task: $taskName</td>\n";
				$tr_bg = "#9fffa7";
				break;
			case 'update':
				$td .= "<td>$userName has updated $field of task: $taskName";
				$td .= "<div>Old $field: $oldValue</div>";
				$td .= "<div>New $field: $newValue</div>";
				$td .= "</td>\n";
				$tr_bg = "#ececec";
				break;
			case 'delete':
				$td .= "<td>$userName has deleted a task: $taskName</td>\n";
				$tr_bg = "#f99696";
				break;

			default:
				$td .= "<td>$userName has $activity"."ed a task: $taskName</td>\n";
				$tr_bg = "#20e547";
				break;
		}

		echo "<tr style='background: $tr_bg'>\n";
		echo "<td class='log_td_time'>$time</td>\n";
		echo $td;
		echo "</tr>\n";

		// echo "<tr>\n";
		// echo "<td class='log_td_time'>$time</td>\n";
		// switch ($activity) {
		// 	case 'add':
		// 		echo "<td>$userName has added a new task: $taskName</td>\n";
		// 		break;
		// 	case 'update':
		// 		echo "<td>$userName has updated $field of task: $taskName";
		// 		echo "<div>Old $field: $oldValue</div>";
		// 		echo "<div>New $field: $newValue</div>";
		// 		echo "</td>\n";
		// 		break;
		// 	case 'delete':
		// 		echo "<td>$userName has deleted a task: $taskName</td>\n";
		// 		break;

		// 	default:
		// 		echo "<td>$userName has $activity"."ed a task: $taskName</td>\n";
		// 		break;
		// }

		// echo "</tr>\n";
	}
	echo "</table>\n";
	
?>
<div style="margin: 20px 0 10px 0;"><span class='span_show_more' id="span_show_more_id" onclick="showMoreActivity()">Show more activities</span></div>
<div id="no_more_log_id"></div>

<?php require('./footer.php') ?>

<script type="text/javascript">
	var logIndex = 10;	// chỉ số của record cần lấy trong database, VD: logIndex = 123 thì ta sẽ query là: SELECT ... LIMIT 123, 10; trong đó 10 là khối lượng bản ghi lấy từ DB mỗi lần request
	// Do trang này ban đầu đã lấy 10 record đầu tiên (từ 0-9) rồi, nên sau khi click vào show more log sẽ bắt đầu hiển thị từ record thứ 11 (thứ tự = 10)
	
	function showMoreActivity() {

		// using AJAX...
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();	// code for modern browsers
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	// code for old IE browsers
		}

		xmlhttp.onreadystatechange = function() {
			var logTable = document.getElementById("log_table");

			if(this.readyState == 4 && this.status == 200) {
				var json = JSON.parse(this.responseText);
				var len = json.length;
				if(len == 0) {
					var newDiv = document.createElement("div");
					newDiv.setAttribute("class", "no_more_log");
					newDiv.appendChild(document.createTextNode("There's no more log to show!!!"));

					var noMoreLog = document.getElementById("no_more_log_id");
					noMoreLog.appendChild(newDiv);

				} else {
					for(var i = 0; i < len; i++) {
						var row = logTable.insertRow(-1);
						switch (json[i]['activity']) {
							case 'add':
								row.setAttribute("style", "background: #9fffa7");
								break;
							case 'update':
								row.setAttribute("style", "background: #ececec");
								break;
							case 'delete':
								row.setAttribute("style", "background: #f99696");
								break;

							default:
								row.setAttribute("style", "background: #000; color: #fff");
								break;
						}
						
						var cell1 = row.insertCell(0);
						var cell2 = row.insertCell(1);
						cell1.innerHTML = json[i]['time'];
						cell2.innerHTML = json[i]['activity_content'];
					}
				}
			}
		}

		xmlhttp.open("GET", "../demos/show_more_log?start=" + logIndex + "&amount=10", true);	// mỗi lần sẽ query lấy 10 record tiếp theo trong bảng log_task
		xmlhttp.send();
		logIndex += 10;	// chú ý: mỗi lần query sẽ chỉ lấy thêm 10 record, nếu muốn lấy số lượng khác thì phải sửa lại cả biến $LIMIT_LOG trong file TasksController.php. Khá vất vả! 
	}
</script>