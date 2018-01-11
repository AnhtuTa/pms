<?php
	/**
	* @param $startDate = thời gian bắt đầu của task (đơn vị: integer (timestamp (số giây tính từ năm 1970 tới nay, xem thêm google)))
	* @param $deadline = thời gian kết thúc của task (đơn vị: integer (timestamp))
	* @param $process = tiến độ của dự án
	* Nếu lúc này đang là 22h56' ngày 3/1 thì deadline = ngày 3/1, 6h0', còn time() = ngày 3/1, 22h56'
	**/
	function getTimeInfo($startDate, $deadline, $process) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		// //$deadline += 24*3600-1;
		// echo "time() = ".time()."<br>";
		// echo "deadline = ".$deadline."<br>";
		// echo "deadline - time() = ".($deadline - time())."<br>"."<br>";
		$result = array();

		$result['total_time'] = ($deadline - $startDate)/24/3600;

		$timeLeft = ($deadline - time())/24/3600;	// số ngày còn lại trước khi tới deadline
		if($timeLeft < 0) {
			if($timeLeft > -1) $timeLeft = $process < 100 ? "<div style='color: #c653ff'><b>Today is deadline!</b></div>" : "<div style='color: #1a5fce'><b>finished!</b></div>";
			else $timeLeft = $process < 100 ? "<div style='color: red'><b>overtime!</b></div>" : "<div style='color: #1a5fce'><b>finished!</b></div>";
			$timeLeft_percent = 0;
		} else {
			$timeLeft = ceil($timeLeft);
			$timeLeft_percent = $result['total_time'] != 0 ? round($timeLeft*100/$result['total_time']) : 0;
			if($process == 100) $timeLeft = "<div style='color: #1a5fce'><b>finished!</b></div>";
		}
		if($timeLeft_percent > 100) $timeLeft_percent = 100;	//đề phòng trường hợp startDate < time() (nghĩa là thời điểm start của task này là trong tương lai)
		
		$result['time_left'] = $timeLeft;
		$result['time_left_percent'] = $timeLeft_percent;

		return $result;
	}

	// Get table header
	function getTh($tableId, $extraTd = false, $userId = "") {
		$result;
		$result = "<tr class='table_header'>\n";
		$result .= "<td class='sortable' onclick=\"sortTable('".$tableId."', 0, '".$userId."')\">Task name <span id=\"desc_0".$userId."\">&#9660;</span><span id=\"asc_0".$userId."\">&#9650</span></td>\n";
		$result .= "<td class='sortable' onclick=\"sortTable('".$tableId."', 1, '".$userId."')\">Start date <span id=\"desc_1".$userId."\">&#9660;</span><span id=\"asc_1".$userId."\">&#9650</span></td>\n";
		$result .= "<td class='sortable' onclick=\"sortTable('".$tableId."', 2, '".$userId."')\">Deadline <span id=\"desc_2".$userId."\">&#9660;</span><span id=\"asc_2".$userId."\">&#9650</span></td>\n";
		$result .= "<td>Time left/Total time</td>\n";
		$result .= "<td class='sortable' onclick=\"sortTable('".$tableId."', 4, '".$userId."')\">Process <span id=\"desc_4".$userId."\">&#9660;</span><span id=\"asc_4".$userId."\">&#9650</span></td>\n";
		$result .= "<td class='sortable' onclick=\"sortTable('".$tableId."', 5, '".$userId."')\">Last update <span id=\"desc_5".$userId."\">&#9660;</span><span id=\"asc_5".$userId."\">&#9650</span></td>\n";
		if($extraTd) $result .= "<td></td>\n";	// my_tasks.ctp sẽ có thêm dòng này
		$result .= "</tr>\n";

		return $result;
	}

	/**
	* Get table row:
	* @param $startDate = thời gian bắt đầu của task (đơn vị: integer (timestamp (số giây tính từ năm 1970 tới nay, xem thêm google)))
	* @param $deadline = thời gian kết thúc của task (đơn vị: integer (timestamp))
	* @param $process = tiến độ của task
	* @param $lastUpdate = thời gian (thân thiện) gần nhất đã cập nhập cái task này (đơn vị: String. VD: 2 days ago, just now, 23 minutes ago...)
	* @param $taskId = ID của task, dùng cho user là student
	**/
	function getTr($taskName, $startDate, $deadline, $totalTime, $timeLeft, $timeLeft_percent, $process, $lastUpdate, $taskId = false) {
		$result;
		$result = "<tr>\n";
		$result .= getTd($taskName, $startDate, $deadline, $totalTime, $timeLeft, $timeLeft_percent, $process, $lastUpdate);
		if($taskId) $result .= "\t<td><span class='btn_edit_task'><a href='edit_task?taskId=".$taskId."'>Edit</a></span></td>\n";
		$result .= "</tr>\n";

		return $result;
	}

	// trả về các thẻ td trong thẻ tr
	function getTd($taskName, $startDate, $deadline, $totalTime, $timeLeft, $timeLeft_percent, $process, $lastUpdate) {
		$startDate_str = date("d/m/Y", $startDate);
		$deadline_str = date("d/m/Y", $deadline);
		$friendlyLastUpdate = myFriendlyDate($lastUpdate);
		
		$result;
		$result = "<td class='task_name'>".$taskName."</td>\n";
		$result .= "<td compare_att='".$startDate."'>".$startDate_str."</td>\n";
		$result .= "<td compare_att='".$deadline."'>".$deadline_str."</td>\n";
		
		$result .= "<td class='process_bar'>".$timeLeft;
		$result .= is_numeric($timeLeft) ? (($timeLeft > 1 ? " days" : " day")."/$totalTime".($totalTime > 1 ? " days" : " day")) : "";
			$result .= "<div style='border: 1px solid #f4427a; height: 12px; margin: 5px 5% 0 0;'>";
				$result .= "<div style='background: #f4427a; width: ".(100 - $timeLeft_percent)."%; height: 12px;'></div>";	// thanh này hiển thị số ngày đã qua, như con số ở trên thanh này lại hiển thị số ngày còn lại
		$result .= "</div></td>\n";

		$result .= "<td compare_att='".$process."' class='process_bar'>".$process."%";
		$result .= "<div style='border: 1px solid #f4427a; height: 12px; margin: 5px 5% 0 0;'>
				<div style='background: #f4427a; width: ".$process."%; height: 12px;'></div>
			</div></td>\n";
		$result .= "<td compare_att='".-strtotime($lastUpdate)."' class='task_last_update'>".$friendlyLastUpdate."</td>\n";

		return $result;
	}
?>