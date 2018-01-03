<?php require('./check_login.php') ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('forum.css'); ?>
<?php require('./menu.php') ?>
<?php require('./DateUtils.php') ?>
<?php require('./ShowPost.php') ?>
<?php echo $this->Html->script('jquery-3.2.1.min.js'); ?>

<?php
	if(isset($noPost)) {
		noPostsFound();
	} else {
		for ($i=0; $i < count($posts); $i++) { 
			showSearchedPost($posts[$i]);
		}
	}
?>