<?php require('./check_login.php') ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('forum.css'); ?>
<?php require('./menu.php') ?>
<?php require('./DateUtils.php') ?>
<?php require('./ShowPost.php') ?>
<?php echo $this->Html->script('jquery-3.2.1.min.js'); ?>

<script src="https://project3nodejs.herokuapp.com/socket.io/socket.io.js"></script>

<?php echo $this->Html->script('forum.js');?>
<?php echo $this->Html->script('sweetalert.min.js');?>
<?php
	$STR_SHOW_CMT = "Show comments";
	$STR_HIDE_CMT = "Hide comments";
	$STR_SO_TYPING = "Someone is typing...";
	$MY_WEBSITE = "http://$_SERVER[HTTP_HOST]"."/project3";
?>

<noscript>
	<meta http-equiv="refresh" content="0; url=<?php echo $MY_WEBSITE."/posts/noJS" ?>" />
	<style type="text/css">div {display: none;}</style>
</noscript>

<?php
	if(isset($post)) {
		echo '<div class="page_wrapper">';
		showPost($post[0], $comments);
		echo "</div>";
	}
	if(isset($postRemoved)) {
		//echo "<h4 class='info_string'>$noPosts</h4>";
		?>
		<div class="warning_post_removed">
			<img src="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/img/warning.png" ?>" height='40p' style="background: red; padding: 5px;">
			<span class="error_string error_post_removed"><?php echo $postRemoved ?></span>
		</div>
		<?php
	}
	if(isset($noPosts)) {
		echo "<h4 class='info_string'>$noPosts</h4>";
	}
	if(isset($errorPostId)) {
		echo "<h4 class='error_string'>$errorPostId</h4>";
	}

?>
<?php require('./forum_js.php') ?>
