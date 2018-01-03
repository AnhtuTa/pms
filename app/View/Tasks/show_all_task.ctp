<?php require("./check_login_and_forbit_student.php") ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
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
					echo "<td>".$item['Task']['name']."</td>";
					echo "<td>".$item['Task']['user_id']."</td>";
					echo "<td>".$item['Task']['start']."</td>";
					echo "<td>".$item['Task']['deadline']."</td>";
					echo "<td>".$item['Task']['process']."</td>";
					echo "</tr>";
				}
			?>
		</table>
		<?php
	}
?>