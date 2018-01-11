<?php
	/**
	* convert datetime_str sang ngày giờ của VN
	* @param $datetime_str : ngày giờ dạng String (lấy từ CSDL), format: yyyy-mm-dd HH:mm:ss
	* return: 1 đối tượng kiểu DateTime, với timezone ở Vietnam
	**/
	// function getVietnamDatetime($datetime_str) {
	// 	if($_SERVER['SERVER_NAME'] == "localhost") {
	// 		//test trên localhost: $datetime_str là giá trị ở múi giờ VN
	// 		//nên cần set timezone là ở VN
	// 		date_default_timezone_set('Asia/Ho_Chi_Minh');
	// 		$datetime = new DateTime($datetime_str);
	// 		return $datetime;
	// 	} else {
	// 		// test trên host thật, ví dụ: 000webhost. Lúc này do thằng phpmyadmin
	// 		// của 000webhost lấy múi giờ là giờ GMT nên $datetime_str là giờ GMT
	// 		date_default_timezone_set('Europe/London');
	// 		$datetime = new DateTime($datetime_str);
	// 		$datetime->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
	// 		return $datetime;
	// 	}
	// }

	/**
	* Lấy datetime hiện tại theo múi giờ Vietnam
	* return: giá trị datetime có dạng: yyyy-mm-dd HH:mm:ss
	**/
	function getVNDatetimeNow() {
		if($_SERVER['SERVER_NAME'] == "localhost") {
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$datetime = new DateTime();
			return date('Y-m-d H:i:s', $datetime->getTimestamp());
		} else {
			$datetime = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('Europe/London'));
			$datetime->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
			return date('Y-m-d H:i:s', $datetime->getTimestamp());
		}
	}

	/** 
	* function to convert date to Vietnamese format
	* @param $datetime_str: kiểu datetime, format: yyyy-mm-dd HH:mm:ss, (nếu trên host thật thì nó theo giờ GMT, nếu test ở localhost thì theo múi giờ của localhost)
	**/
	function myFormatDate($datetime_str) {
		if($_SERVER['SERVER_NAME'] == "localhost") {
			$datetime = new DateTime($datetime_str);
			return date('F d, Y, \a\t H\hi', $datetime->getTimestamp());
		} else {
			date_default_timezone_set('Europe/London');
			$datetime = new DateTime();
			$datetime->add(new DateInterval('P0Y0M0DT7H0M0S'));     //add thêm 7 tiếng vào biến này. đm PHP như c*c
			return date('F d, Y, \a\t H\hi', $datetime->getTimestamp());
		}
	}

	/**
	* convert timestamp to friendly time
	* @param $datetime_str: kiểu string: là thời gian hiện tại, theo format: yyyy-mm-dd HH:mm:ss. Biến này lấy từ CSDL
	**/
	function myFriendlyDate($datetime_str) {
		$JUST_NOW = "Just now";
		$MINUTE_AGO = " minute ago";
		$MINUTES_AGO = " minutes ago";
		$DAY_AGO = " day ago";
		$DAYS_AGO = " days ago";
		$HOUR_AGO = " hour ago";
		$HOURS_AGO = " hours ago";

		if($_SERVER['SERVER_NAME'] != "localhost") date_default_timezone_set('Europe/London');
		else date_default_timezone_set('Asia/Ho_Chi_Minh');
		$datetime = strtotime($datetime_str);
		$differrence = time() - $datetime;

		if($differrence < 60) return $JUST_NOW;		//.", differrence = $differrence";
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