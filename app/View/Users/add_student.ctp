<?php require("./check_login_and_forbit_student.php") ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php require('./menu.php') ?>
<title>Add student</title>

<script type="text/javascript">
	function validateInput() {
		// code validate input here...
		return true;
	}
</script>

<div class="form_wrapper">
<form method="post" action="" onsubmit="return validateInput()">
	<table class="form_table">
		<tr>
			<td class="form_label">Username</td>
			<td><input class="form_input" type="text" id="txt_user" name="txt_user" value="<?php echo isset($user) ? $user : '' ?>" required></td>
		</tr>
		<tr>
			<td class="form_label">Password</td>
			<td><input class="form_input" type="text" id="txt_pass" name="txt_pass" value="<?php echo isset($pass) ? $pass : '' ?>" required></td>
		</tr>
		<tr>
			<td class="form_label">Student's name</td>
			<td><input class="form_input" type="text" id="txt_name" name="txt_name" value="<?php echo isset($name) ? $name : '' ?>" required></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input class="normal_btn btn_save" type="submit" name="btn_submit" value="Save">
				<a style='color: red' href="../tasks/show_all_tasks">Cancel</a>
			</td>
		</tr>
	</table>
</form>
<h3><?php echo isset($infoString) ? $infoString : ''?></h3>
<h3><?php echo isset($errorString) ? $errorString : ''?></h3>
<?php require('./footer.php') ?>