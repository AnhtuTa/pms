<header class="head">
	<div>
		<a class="logo" href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/users" ?>"><?php echo $this->Html->image('bkhn.png', array('alt' => 'logo BKHN', 'height' => '72px')); ?></a>
		<div class="pNextLogo">Project management system</div>
	</div>
	<div style="clear: both;"></div>

	<ul>
		<li><a href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/users" ?>">Home</a></li>
		<li><a href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/users/add_student" ?>">Add student</a></li>
		<li><a href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/tasks/show_all_tasks" ?>" style="width: 140px;">Students' tasks</a></li>
		<li><a href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/tasks/student_log" ?>">Student logs</a></li>
		<li><a href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/posts" ?>">Forum</a></li>
		<li><a href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/users/info" ?>">My Profile</a></li>	
		<li><a href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/users/logout" ?>">Logout</a></li>
	</ul>
</header>