<?php
	/**
	* @param $startDate = thời gian bắt đầu của task (đơn vị: integer (timestamp (số giây tính từ năm 1970 tới nay, xem thêm google)))
	* @param $deadline = thời gian kết thúc của task (đơn vị: integer (timestamp))
	* @param $process = tiến độ của dự án
	**/
	function getTimeInfo($startDate, $deadline, $process) {
		$result = array();

		$result['total_time'] = ($deadline - $startDate)/24/3600;

		$timeLeft = ($deadline - time())/24/3600;	// số ngày còn lại trước khi tới deadline
		if($timeLeft < 0) {
			$timeLeft = $process < 100 ? "<div style='color: red'><b>overtime!</b></div>" : "<div style='color: #1a5fce'><b>finished!</b></div>";
			$timeLeft_percent = 0;
		} else {
			$timeLeft = ceil($timeLeft);
			$timeLeft_percent = round($timeLeft*100/$result['total_time']);
			if($process == 100) $timeLeft = "<div style='color: #1a5fce'><b>finished!</b></div>";
		}
		if($timeLeft_percent > 100) $timeLeft_percent = 100;	//đề phòng trường hợp startDate < time() (nghĩa là thời điểm start của task này là trong tương lai)
		
		$result['time_left'] = $timeLeft;
		$result['time_left_percent'] = $timeLeft_percent;

		return $result;
	}

	// Get table header
	function getTh($extraTd = false) {
		$result;
		$result = "<tr class='table_header'>\n";
		$result .= "<td>Task name</td>\n";
		$result .= "<td>Start date</td>\n";
		$result .= "<td>Deadline</td>\n";
		$result .= "<td>Time left/Total time</td>\n";
		$result .= "<td>Process</td>\n";
		$result .= "<td>Last update</td>\n";
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
		$startDate = date("d/m/Y", $startDate);
		$deadline = date("d/m/Y", $deadline);
		
		$result;
		$result = "<td class='task_name'>".$taskName."</td>\n";
		$result .= "<td>".$startDate."</td>\n";
		$result .= "<td>".$deadline."</td>\n";
		
		$result .= "<td class='process_bar'>".$timeLeft;
		$result .= is_numeric($timeLeft) ? (($timeLeft > 1 ? " days" : " day")."/$totalTime".($totalTime > 1 ? " days" : " day")) : "";
			$result .= "<div style='border: 1px solid #f4427a; height: 12px; margin: 5px 5% 0 0;'>";
				$result .= "<div style='background: #f4427a; width: ".(100 - $timeLeft_percent)."%; height: 12px;'></div>";	// thanh này hiển thị số ngày đã qua, như con số ở trên thanh này lại hiển thị số ngày còn lại
		$result .= "</div></td>\n";

		$result .= "<td class='process_bar'>".$process."%";
		$result .= "<div style='border: 1px solid #f4427a; height: 12px; margin: 5px 5% 0 0;'>
				<div style='background: #f4427a; width: ".$process."%; height: 12px;'></div>
			</div></td>\n";
		$result .= "<td class='task_last_update'>".$lastUpdate."</td>\n";

		return $result;
	}
?>