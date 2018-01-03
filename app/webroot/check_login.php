<?php
	// Nếu trang nào mà cả SV và GV đều có quyền vào (VD: trang info) thì dùng file này
	if(!isset($_SESSION['userRole'])) {
		echo "<h3 style='color: red;'>Error! You have to login first. <a href='"."http://$_SERVER[HTTP_HOST]"."/project3/users/login"."'>Click here</a> to login!</h3>";
		exit();
	}
?>
