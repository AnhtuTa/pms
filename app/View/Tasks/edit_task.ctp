<?php require("./check_login_and_forbit_teacher.php") ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('task.css'); ?>
<?php require('./menu.php') ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="form_wrapper">
<form method="post" action="">
	<table>
		<tr>
			<td class="form_label">Task name</td>
			<td><input class="form_input" type="text" name="txt_taskName" value="<?php echo isset($taskName) ? $taskName : '' ?>"></td>
		</tr>
		<tr>
			<td class="form_label">Start date</td>
			<td><input class="form_input" type="date" name="txt_start" value="<?php echo isset($start) ? $start : '' ?>"></td>
		</tr>
		<tr>
			<td class="form_label">Deadline</td>
			<td><input class="form_input" type="date" name="txt_deadline" value="<?php echo isset($deadline) ? $deadline : '' ?>"></td>
		</tr>	
		<tr>
			<td class="form_label">Process</td>
			<td><input class="form_input" type="text" name="txt_process" value="<?php echo isset($process) ? $process : '' ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button class="normal_btn btn_save" type="submit" name="btn_save">Save</button>
				<button class="normal_btn btn_delete" type="button" name="btn_delete" id="btn_delete_id"
					onclick="deleteTask(<?php echo isset($taskId) ? $taskId : '' ?>)">Delete</button>
				<a style='color: red' href="my_tasks">Cancel</a>
			</td>
		</tr>
	</table>
	<input style="display: none" name="taskId" value="<?php echo isset($taskId) ? $taskId : 'what is this?' ?>" />
</form>
</div>
<h3><?php echo isset($infoString) ? $infoString : ''?></h3>

<script type="text/javascript">
	function deleteTask(taskId) {
		swal({
			title: "Are you sure to delete?",
			text: "Once deleted, you will not be able to recover this task!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				//delete this comment in DB
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();	// code for modern browsers
				} else {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	// code for old IE browsers
				}

				xmlhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
						//console.log("Bạns vừa comment! ID của comment này là: " + this.responseText);
						window.location.href = '<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/tasks/my_tasks" ?>';	// Dùng cái này hay hơn thay vì dùng JS bên trang /demos/delete_task để redirect
					}
				}

				xmlhttp.open("POST", "<?php echo $MY_WEBSITE ?>/demos/delete_task");
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send("taskId=" + taskId);
  
			} else {
				swal("Your task is still safe! Phew!!!");
			}
		});

	}

</script>