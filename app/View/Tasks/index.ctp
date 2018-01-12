<?php
	if(!isset($_SESSION['userRole'])) {
		header("Location: "."http://$_SERVER[HTTP_HOST]"."/project3/users/login");
		die();
	} else if($_SESSION['userRole'] == 1) {
		header("Location: "."http://$_SERVER[HTTP_HOST]"."/project3/tasks/show_all_tasks");
		die();
	} else if($_SESSION['userRole'] == 2) {
		header("Location: "."http://$_SERVER[HTTP_HOST]"."/project3/tasks/my_tasks");
		die();
	}
	// header chỉ dùng đc khi chưa đc send. Nếu send rồi thì phải dùng JS. deploy lên 000webhost.com thì bị như vậy
	// trường hợp trên là header chưa đc send
?>
<?php require('./footer.php') ?>