<?php require('./check_login.php') ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php require('./menu.php') ?>

<?php 
	if(isset($_SESSION['changePassStatus']) && $_SESSION['changePassStatus'] == 1) {
		echo "<h4 class='info_string'>Change password success!</h4>";
		unset($_SESSION['changePassStatus']);
	}
	if(isset($_SESSION['changeNameStatus']) && $_SESSION['changeNameStatus'] == 1) {
		echo "<h4 class='info_string'>Change name success!</h4>";
		unset($_SESSION['changeNameStatus']);
	}
?>

<h3>Welcome <?php echo $_SESSION['userName']; ?></h3>
<div style="margin-bottom: 20px;">You're login using account: <?php echo $_SESSION['userId'];?>!</div>
<div><a href="edit_info">Edit information</a></div>
<div><a href="change_password">Change password</a></div>
<div><a href="logout">Logout</a></div>

<?php require('./footer.php') ?>