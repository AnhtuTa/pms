<?php echo $this->Html->css('login.css'); ?>
<div class='div_login'>
	<form method="post" action="" class="login_form">
		<h3 class="login_header">Login</h3>

		<input class="login_txt" type="text" name="username" value="<?php if(isset($user_resend)) echo $user_resend; ?>" placeholder="Username" /><br />
		<input class="login_txt" type="password" name="password" placeholder="Password" /><br />
		<div class="login_error" <?php if(isset($error)) echo "style='padding: 5px;'" ?> ><?php if(isset($error)) echo $error; ?></div>
		
		<input class="login_submit" style='margin-top: 10px;' type="submit" name="btnLogin" value="Login" />

		<div style="color: blue"><?php if(isset($infoString)) echo $infoString; ?></div>
	</form>
</div>
<!-- Sau khi ấn submit thì sẽ server lại sẽ xử lý kq trong hàm login() -->
