<?php $MY_WEBSITE = "http://$_SERVER[HTTP_HOST]"."/project3" ?>
<header class="head">
	<div style="float: left;">
		<a class="logo" href="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/users" ?>"><?php echo $this->Html->image('bkhn.png', array('alt' => 'logo BKHN', 'height' => '72px')); ?></a>
		<div class="pNextLogo">Project management system</div>
	</div>
	<div style="clear: both;"></div>

	<ul>
		<span class="menu_wrapper">
			<li><a href="<?php echo $MY_WEBSITE."/users" ?>">Home</a></li>
			<li>
				<a href="javascript:void(0)">
					Tasks <span class="caret_down">&#9660;</span><span class="caret_up">&#9650</span>
				</a>
				<ul class="sub-menu">
					<li><a href="<?php echo $MY_WEBSITE."/tasks/my_tasks" ?>">My tasks</a></li>
					<li><a href="<?php echo $MY_WEBSITE."/tasks/add_task" ?>">Add task</a></li>
				</ul>
			</li>
			<li><a href="<?php echo $MY_WEBSITE."/posts" ?>">Forum</a></li>
			<li><a href="<?php echo $MY_WEBSITE."/users/info" ?>">My Profile</a></li>
			<li><a href="<?php echo $MY_WEBSITE."/users/logout" ?>">Logout</a></li>		
		</span>
	</ul>
</header>