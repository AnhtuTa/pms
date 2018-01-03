<?php require("./check_login_and_forbit_student.php") ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php require('./menu.php') ?>

<style type="text/css">
	
</style>
<h2>These are all tasks</h2>
<?php
	if($allTasks == null) {
		echo "Data empty!";
	} else {
		?>
		<table>
			<tr>
				<td class="table_header">Task name</td>
				<td class="table_header">Person in charge</td>
				<td class="table_header">Start date</td>
				<td class="table_header">Deadline</td>
				<td class="table_header">Process</td>
			</tr>
			<?php
				foreach ($allTasks as $item) {
					echo "<tr id=".$item['t']['id'].">\n";
					echo "\t<td>".$item['t']['taskName']."</td>\n";
					echo "\t<td>".$item['u']['personInCharge']."</td>\n";
					echo "\t<td>".date("d/m/Y", strtotime($item['t']['start']))."</td>\n";
					echo "\t<td>".date("d/m/Y", strtotime($item['t']['deadline']))."</td>\n";
					echo "\t<td>".$item['t']['process']."</td>\n";
					echo "</tr>\n";
				}
			?>
		</table>
		<?php
	}
?>