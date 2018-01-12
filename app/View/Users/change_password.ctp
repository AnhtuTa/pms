<?php require("./check_login.php") ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php require('./menu.php') ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php if (!isset($oldPasswordValid)) { ?>
<form method="post" action="">
	<table>
		<tr>
			<td class="table_header">Enter your old password</td>
			<td><input type="password" name="txt_oldPass"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button class="normal_btn btn_save" type="submit" name="btn_submitOldPass">Next</button>
				<button class="normal_btn btn_save btn_cancel"><a href="info">Cancel</a></button>
			</td>
		</tr>
	</table>
</form>
<?php } ?>
<h3 class="error_string"><?php echo isset($errorString) ? $errorString : ''?></h3>

<?php if (isset($oldPasswordValid)) { ?>
	<form method="post" action="">
	<table>
		<tr>
			<td class="table_header">Enter new password</td>
			<td><input type="password" name="txt_newPass1" required value="<?php if(isset($newPass1)) echo $newPass1; ?>"></td>
		</tr>
		<tr>
			<td class="table_header">Retype new password</td>
			<td><input type="password" name="txt_newPass2" value="<?php if(isset($newPass1)) echo $newPass2; ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button class="normal_btn btn_save" type="submit" name="btn_save">Save</button>
				<button class="normal_btn btn_save btn_cancel"><a href="info">Cancel</a></button>
			</td>
		</tr>
	</table>
</form>
<?php } ?>
<h3 class="error_string"><?php echo isset($errorString2) ? $errorString2 : ''?></h3>
<?php require('./footer.php') ?>
