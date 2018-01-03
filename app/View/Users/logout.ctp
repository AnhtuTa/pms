<?php $MY_WEBSITE = "http://$_SERVER[HTTP_HOST]"."/project3" ?>
<?php
	// header("Location: ".$MY_WEBSITE."/users/login");
	// die();
?>
<script type='text/javascript'>
	var STR_MY_WEBSITE = location.protocol + '//' + location.hostname + (location.port ? (':' + location.port) : '') + '/project3';
	window.location = STR_MY_WEBSITE + '/users/login';
</script>