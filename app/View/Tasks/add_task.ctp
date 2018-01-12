<?php require("./check_login_and_forbit_teacher.php") ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php require('./menu.php') ?>
<?php require('./TaskUtils.php') ?>
<?php require('./DateUtils.php') ?>

<div class="form_wrapper">
<form method="post" action="">
	<table class="form_table">
		<tr>
			<td class="form_label">Task name</td>
			<td><input class="form_input" type="text" name="txt_taskName" required></td>
		</tr>
		<tr>
			<td class="form_label">Start date</td>
			<td><input class="form_input" type="date" name="txt_start"></td>
		</tr>
		<tr>
			<td class="form_label">Deadline</td>
			<td><input class="form_input" type="date" name="txt_deadline"></td>
		</tr>	
		<tr>
			<td class="form_label">Process</td>
			<td><input class="form_input" type="text" name="txt_process" value="0" required></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button class="normal_btn btn_save" type="submit" name="btn_save" value="Save">Save</button>
				<a style='color: red' href="my_tasks">Cancel</a>
			</td>
		</tr>
	</table>
	<input style="display: none" name="taskId" value="<?php echo isset($taskId) ? $taskId : 'what is this?' ?>" />
</form>
</div>
<h3><?php echo isset($errorString) ? $errorString : ''?></h3>
<?php require('./footer.php') ?>