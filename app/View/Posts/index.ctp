<?php require('./check_login.php') ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php echo $this->Html->css('forum.css'); ?>
<?php require('./menu.php') ?>
<?php require('./DateUtils.php') ?>
<?php require('./ShowPost.php') ?>
<?php echo $this->Html->script('jquery-3.2.1.min.js'); ?>

<!--
<script src="http://<?php //echo $_SERVER['SERVER_NAME'] ?>:8000/socket.io/socket.io.js"></script>
-->

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

<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

<div class="page_wrapper">
	<!-- <h2>Chú ý: Hiện tại forum vẫn lỗi: ko xóa đc comment, và vài lỗi khác... F*ck 000webhost!!!</h2>
	<h2>Thử trên localhost chạy ngon mà cho lên host thật lại lỗi!!!</h2> -->
	<?php if($currentPage == 1) { ?>

	<div class="write_post_wrapper">
		<h3>Post something in forum</h3>
		<form method="post" action="<?php echo "http://$_SERVER[HTTP_HOST]"."/project3/posts/add_post" ?>">
			<div class="write_post_inner_wrapper">
				<textarea class="write_post_box" name="txt_writePost" placeholder="what the heck do you want to ask..." onkeyup="writePostKeyUp(this)"></textarea>
				<input class="normal_btn btn_save write_post_btn" id="write_post_btn_id" type="submit" value="Post" disabled="disabled" name="btn_writePost">
			</div>
		</form>
	</div>
	<div id="info_after_post_id" class="info_after_post"><?php if(isset($infoString)) echo $infoString; ?></div>
	<div style="margin-bottom: 40px;"></div>
	<?php }?>
	
	<?php 
		foreach ($tenNewestPosts as $item) {
			$post_id = $item['p']['id'];
			$commentOfThisPost = $commentOf10Post[$post_id];
			showPost($item, $commentOfThisPost);
		}

		if(isset($errorPageNumber)) {
			echo "<div style='color: red;'>$errorPageNumber</div>";
		}
	?>
</div>
<?php showSidebar($notifications); ?>
<div style="clear: both"></div>

<div class="page_list">
	<?php
		function printPageNum($i) {
			echo "<a href='http://$_SERVER[HTTP_HOST]/project3/posts?page=".$i."'>".$i."</a> ";
		}

		if(isset($currentPage)) {
			if($currentPage > 1) {
				echo "<a href='http://$_SERVER[HTTP_HOST]/project3/posts?page=".($currentPage - 1)."'><< Previous</a> ";
			}

			//============= algorithm in here ==================//
			$amountOfPages = $_SESSION['amountOfPages'];
			if($amountOfPages < 15) {
				for ($i=1; $i < $amountOfPages; $i++) {
					if($i == $currentPage) echo "<b>$i</b> ";
					else //echo "<a href='http://$_SERVER[HTTP_HOST]/project3/posts?page=".$i."'>".$i."</a> ";
						printPageNum($i);
				}

				if($amountOfPages == $currentPage) echo "<b>$amountOfPages</b> ";
				else //echo "<a href='http://$_SERVER[HTTP_HOST]/project3/posts?page=".$amountOfPages."'>".$amountOfPages."</a> ";
					printPageNum($amountOfPages);
			} else {
				if($currentPage <= 5) {		// là 1 trong 5 trang đầu tiên
					for ($i=1; $i <= 6; $i++) {
						if($i == $currentPage) echo "<b>$i</b> ";
						else printPageNum($i);
					}
					echo "... ";
					for ($i=$amountOfPages - 2; $i <= $amountOfPages; $i++) { 
						printPageNum($i);
					}
				} else if($currentPage >= $amountOfPages - 4) {		// là 1 trong 5 trang cuối
					for ($i=1; $i <= 3; $i++) {
						printPageNum($i);
					}
					echo "... ";
					for ($i=$amountOfPages - 5; $i <= $amountOfPages; $i++) { 
						if($i == $currentPage) echo "<b>$i</b> ";
						else printPageNum($i);
					}
				} else {		// là 1 trang ở giữa
					for ($i=1; $i <= 3; $i++) {
						printPageNum($i);
					}
					echo "... ";
					for ($i=-1; $i <= 1; $i++) {
						$temp = $currentPage + $i;
						if($temp == $currentPage) echo "<b>$temp</b> ";
						else printPageNum($temp);
					}
					echo "... ";
					for ($i=$amountOfPages - 2; $i <= $amountOfPages; $i++) { 
						printPageNum($i);
					}
				}
			}
			//============= algorithm end here ==================//

			if($currentPage < $amountOfPages) {
				echo "<a href='http://$_SERVER[HTTP_HOST]/project3/posts?page=".($currentPage + 1)."'>Next >></a> ";
			}
		}
	?>
</div>

<?php require('./forum_js.php') ?>

<?php //echo "time now = ".date("Y-m-d H:i:s")."<br>" ?>
<?php
	//echo myFormatDate(strtotime(date('Y-m-d H:i:s')))."<br>";
	//echo strtotime(date('Y-m-d H:i:s'))."<br>";

	// $demo = "Let's do it,\n it's OK".'.\nMy name is "Anhtu"';
	// //$kq = preg_replace_all("/([^\])'/","$1\'",$demo);
	// //$kq = addslashes($demo);
	// //$kq = str_replace("'", "\\'", $demo);
	// $kq = addcslashes($demo, "'");

	// $kq = nl2br($kq);
	// echo "demo = $demo"."<br>";
	// echo "kq = $kq";

	// $datetime = new DateTime("2018-01-11 14:00:00", new DateTimeZone('Europe/London'));
	// echo $datetime->format('Y-m-d H:i:sP')."<br>";
	// $datetime->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
	// echo $datetime->format('Y-m-d H:i:sP')."<br>";
	// echo $datetime->format('F d, Y, \a\t H\hi')."<br>";
	// $kq = $datetime->format('F d, Y, \a\t H\hi')."<br>";
	// echo "kq = ".$kq."<br>";
	// echo $_SERVER['SERVER_NAME']."<br>";
	// echo $_SERVER['HTTP_HOST']."<br>";

	// echo date_default_timezone_get()."<br>";
	// echo time()."<br>";
	// echo "After set timezone in VN<br>";
	// date_default_timezone_set('Asia/Ho_Chi_Minh');
	// echo date_default_timezone_get()."<br>";
	// echo time()."<br>";

	// $datetime_now = new DateTime("2018-01-11 18:20:00");
	// echo $datetime_now->format('Y-m-d H:i:s')."<br>";
	// $datetime_now->setTimezone(new DateTimeZone('Europe/London'));
	// echo $datetime_now->format('Y-m-d H:i:s')."<br>";

	// // CHÚ Ý: hàm time() là số giây chênh lệnh giữa hiện tại và ngày 1/1/1970, do đó
	// // ở múi giờ nào thì nó vẫn như nhau, vì thời gian lúc 1/1/1970 cũng ở cùng múi
	// // giờ so với hàm time()

	// date_default_timezone_set('Asia/Ho_Chi_Minh');
	// echo date('Y-m-d H:i:s')."<br>";

	// $date = new DateTime('2018-01-11 14:00:00', new DateTimeZone('Europe/London'));
	// echo $date->format('Y-m-d H:i:sP')."<br>";

	// $date->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
	// echo $date->format('Y-m-d H:i:sP')."<br>";
	// echo date('F d, Y, \a\t H\hi', $date->getTimestamp());
?>

