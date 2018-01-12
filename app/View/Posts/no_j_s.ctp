<?php require('./check_login.php') ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('forum.css'); ?>
<?php require('./menu.php') ?>
<?php echo $this->Html->script('jquery-3.2.1.min.js'); ?>

<?php $MY_WEBSITE = "http://$_SERVER[HTTP_HOST]"."/project3"; ?>
<div class="page_wrapper" id="div_parent">
	<div id="div_child" class="div_no_JS_wrapper">
		<h3 style="padding: 10px; margin: 0;">Javascript required</h3>
		<div class="div_no_JS">
			This page doesn't work properly without JavaScript enabled. Here are the 
			<a class="a_no_JS" href="https://www.enable-javascript.com/" target="_blank">
 			instructions how to enable JavaScript in your web browser</a>.

 			<div style="margin-top: 20px;">
 				<a href="<?php echo $MY_WEBSITE."/posts" ?>" class="a_btn">Reload page</a>
 			</div>
		</div>
	</div>
</div>

<?php require('./footer.php') ?>
<script type="text/javascript">
	var parent = document.getElementById("div_parent");
	var child = document.getElementById("div_child");
	parent.removeChild(child);
	history.go(-1);
</script>
