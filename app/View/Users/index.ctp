<?php require('./check_login.php') ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php require('./menu.php') ?>

<h2>Welcome to project management system!</h2>
<?php
	header('Location: http://'.$_SERVER[HTTP_HOST].'/project3/home');
	?>
	<script type="text/javascript">
		var STR_MY_WEBSITE = location.protocol + '//' + location.hostname + (location.port ? (':' + location.port) : '') + "/project3";
		window.location = STR_MY_WEBSITE + "/home";
	</script>
	<?php
	die();
?>
<?php require('./footer.php') ?>