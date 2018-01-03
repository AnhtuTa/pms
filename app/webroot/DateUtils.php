<?php
	
	/** 
	* function to convert date to Vietnamese format
	* @param $timestamp: kiểu int: là thời gian hiện tại tính = giây
	**/
	function myFormatDate($timestamp) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		return date('F d, Y, \a\t H\hi', $timestamp);
	}

	/**
	* convert timestamp to friendly time
	* @param $datetime_str: kiểu string: là thời gian hiện tại, theo format: yyyy-mm-dd HH:mm:ss
	* @param $isTimestamp: xác định $datetime_str là kiểu string hay int.
	*	Nếu $isTimestamp = false hoặc ko nhập vào (nếu ko nhập thì giá trị biến này = false) thì $datetime_str là 1 String, theo format: yyyy-mm-dd HH:mm:ss. VD: 2017-12-25 23:45:25
	*	Nếu $isTimestamp = true thì $datetime_str là timestamp, kiểu int
	**/
	function myFriendlyDate($datetime_str, $isTimestamp = false) {
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$JUST_NOW = "Just now";
		$MINUTE_AGO = " minute ago";
		$MINUTES_AGO = " minutes ago";
		$DAY_AGO = " day ago";
		$DAYS_AGO = " days ago";
		$HOUR_AGO = " hour ago";
		$HOURS_AGO = " hours ago";

		if($isTimestamp == false) {
			$datetime = strtotime($datetime_str);
			$differrence = time() - $datetime;
		} else {
			$differrence = time() - $datetime_str;
		}

		if($differrence < 60) return $JUST_NOW;
		if($differrence < 3600) {
			$minute = round($differrence/60);
			return $minute > 1 ? $minute.$MINUTES_AGO : $minute.$MINUTE_AGO;
		}
		if($differrence < 24*3600) {
			$hour = round($differrence/3600);
			if($hour == 24) return "1".$DAY_AGO;
			return $hour > 1 ? $hour.$HOURS_AGO : $hour.$HOUR_AGO;
		}

		$day = round($differrence/24/3600);
		return $day > 1 ? $day.$DAYS_AGO : $day.$DAY_AGO;


		// echo round(1.2)."<br>";
		// echo round(1.7)."<br>";
		// echo ceil(1.2)."<br>";
		// echo ceil(1.7)."<br>";
		// echo floor(1.2)."<br>";
		// echo floor(1.7)."<br><br>";

		// echo "differrence = $differrence<br>";
		// echo "2017-12-16 = ".(strtotime("2017-12-16"))."<br>";
		// echo "2017-12-16 23:00:00 = ".(strtotime("2017-12-16 23:00:00"))."<br>";
		// echo "datetime = $datetime<br>";
		// echo "strtotime(\"2017-12-16 23:00:00\") = ".strtotime("2017-12-16 23:00:00")."<br>";
		// echo "time() = ".time()."<br><br><br>";
	}
?>