<?php require("./check_login_and_forbit_student.php") ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php require('./menu.php') ?>

<h2>These are all tasks</h2>
<h3>This page is only for testing and debug! You should use this <a href="show_all_tasks">link</a> to see all students' tasks</h3>
<?php
	if($allTasks == null) {
		echo "Data empty!";
	} else {
		?>
		<table>
			<tr>
				<td>Task name</td>
				<td>Person in charge</td>
				<td>Start date</td>
				<td>deadline</td>
				<td>process</td>
			</tr>
			<?php
				foreach ($allTasks as $item) {
					echo "<tr>";
					echo "<td>".$item['tasks']['name']."</td>";
					echo "<td>".$item['tasks']['user_id']."</td>";
					echo "<td>".$item['tasks']['start']."</td>";
					echo "<td>".$item['tasks']['deadline']."</td>";
					echo "<td>".$item['tasks']['process']."</td>";
					echo "</tr>";
				}
			?>
		</table>
		<?php
	}
?>