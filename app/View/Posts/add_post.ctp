<?php
	if(isset($errorString)) {
		require('./check_login.php');
		echo $this->Html->css('my_cake.generic.css');
		echo $this->Html->css('myproject3.css');
		echo $this->Html->css('forum.css');
		require('./menu.php');

		echo "<h3 class='error_string'>".$errorString."</h3>";
	} else if(isset($postSuccess)) {
		$_SESSION['infoAfterAddPost'] = "Your post has been posted in the forum! Check it out!";
		// header('Location: '.$_SERVER['HTTP_REFERER']);
		// die();
		echo "<script type='text/javascript'>
				var STR_MY_WEBSITE = location.protocol + '//' + location.hostname + (location.port ? (':' + location.port) : '') + '/project3';
				window.location = STR_MY_WEBSITE + '/posts/';
			</script>";
	}
?>
