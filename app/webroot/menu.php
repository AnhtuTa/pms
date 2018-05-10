<?php
	$SESSION_TIMEOUT = 15*60;	//seconds
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $SESSION_TIMEOUT)) {
	    session_unset();     // unset $_SESSION variable for the run-time 
	    session_destroy();   // destroy session data in storage
	    echo "<div style='text-align: center; padding-top: 20px;'>";
	    echo "<h3>Timeout! Your session has been closed!</h3>";
	    echo "<h3><a href='"."http://$_SERVER[HTTP_HOST]"."/project3/users/login"."'>Click here</a> to login again!</h3>";
	    echo "</div>";
	    exit();
	} else {
		$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	}

	if(isset($_SESSION['userRole'])) {
		?>
		<div class="menu_welcome">
			<span style="font-size: 14px;">
				Welcome 
				<span style="font-weight: bold;">
					<a href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/users/info" ?>" style="color:blue;">
						<?php echo $_SESSION['userName'] ?>
					</a>
				</span> 
				[<a href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/users/logout" ?>" style="font-weight: bold;">Logout</a>]
			</span>
		</div>
		<?php
		if($_SESSION['userRole'] == 1) {
			require("menu_teacher.php");
		} else if($_SESSION['userRole'] == 2) {
			require("menu_student.php");
		}
		echo "<div style='margin-bottom: 15px;' id='menu_separator'></div>";
	}
?>