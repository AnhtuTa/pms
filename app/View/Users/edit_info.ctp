<?php require("./check_login.php") ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php require('./menu.php') ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<form method="post" action="">
	<table>
		<tr>
			<td class="table_header">Name</td>
			<td><input type="text" name="txt_name" value="<?php echo $_SESSION['userName'] ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button class="normal_btn btn_save" type="submit" name="btn_save">Save</button>
				<a style='color: red' href="info">Cancel</a>
			</td>
		</tr>
	</table>
</form>
<h3><?php echo isset($infoString) ? $infoString : ''?></h3>