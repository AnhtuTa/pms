<?php
	// Nếu trang nào mà chỉ GV có quyền vào (VD: trang add_student) thì dùng file này
	require("check_login.php");
	if($_SESSION['userRole'] == 2) {
		echo "<h3 style='color: red;'>Error! You don't have permission to access this location!</h3>";
		exit();
	}
?>