
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('forum.css'); ?>
<style type="text/css">
	.demo {
		
	}
</style>
<div class="write_post_wrapper">
	<h3>Post something in forum</h3>
	<form  style="border: 2px solid blue;" method="get">
		<div class="demo" style="border: 2px solid red;">
			<textarea class="write_post_box" name="txt_writePost" placeholder="what the heck do you want to ask..."></textarea>
			<input class="write_post_btn" type="submit" value="Đăng bài" name="btn_writePost">
			<div class="clear_both"></div>
		</div>
		
	</form>
	<input type="button" onclick="location.reload();">
</div>
