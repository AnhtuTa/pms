<?php
	// Nếu trang nào mà chỉ SV có quyền vào (VD: trang my_tasks) thì dùng file này
	require("check_login.php");
	if($_SESSION['userRole'] == 1) {
		echo "<h3 style='color: red;'>Error! You don't have permission to access this location!</h3>";
		exit();
	}
?>