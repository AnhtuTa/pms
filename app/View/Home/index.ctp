<?php require('./check_login.php') ?>
<?php echo $this->Html->css('my_cake.generic.css'); ?>
<?php echo $this->Html->css('myproject3.css'); ?>
<?php require('./menu.php') ?>

<?php echo $this->Html->css('bai68.css'); ?>
<body>
	<div class="all_slides">
		<div class="each_slide_wrapper active_sld" id="each_slide_wrapper_1">
			<div class="each_slide">
				<div class="image pos_abs" style="background-image:url(/project3/img/slide1.jpg)"></div>
				<img class="pos_abs bottom_image1" src="/project3/img/bottom_brown.png">
				<div class="pos_abs img2_wrapper">
					<img src="/project3/img/bottom_brown.png" class="bottom_image2 hidden" id="bottom_image2_1">
				</div>
				<div class="pos_abs img3_wrapper">
					<img src="/project3/img/top_brown.png" class="top_image1">
				</div>

				<div class="texts pos_abs">
					<h2>01</h2>
					<h3>WELCOME TO PROJECT MANAGEMENT SYSTEM</h3>
					<div class="separator"></div>
					<p>This website will help you manage and control your project easily.</p>
					<div class="see_project_wrapper">
						<a class="see_project" href="https://github.com/AnhtuTa/Javascript_Edumall"
						target="_blank">See project</a>
					</div>
				</div>
			</div>
		</div>

		<div class="each_slide_wrapper hidden heigh_zero" id="each_slide_wrapper_2">
			<div class="each_slide">
				<div class="image pos_abs" style="background-image:url(/project3/img/slide2.jpg)"></div>
				<img class="pos_abs bottom_image1" src="/project3/img/bottom_brown.png">
				<div class="pos_abs img2_wrapper">
					<img src="/project3/img/bottom_brown.png" class="bottom_image2 hidden" id="bottom_image2_2">
				</div>
				<div class="pos_abs img3_wrapper">
					<img src="/project3/img/top_brown.png" class="top_image1">
				</div>

				<div class="texts pos_abs">
					<h2>02</h2>
					<h3>What more</h3>
					<div class="separator"></div>
					<p>It can also help you to create tasks, manage all tasks and 
						warning you about deadline, process of your project.<br>It also
						has a forum for you and your teammates to ask and discuss
						each other about anything you concern!</p>
					<div class="see_project_wrapper">
						<a class="see_project" href="https://github.com/AnhtuTa/Javascript_Edumall"
						target="_blank">See project</a>
					</div>
				</div>
			</div>
		</div>

		<div class="each_slide_wrapper hidden heigh_zero" id="each_slide_wrapper_3">
			<div class="each_slide">
				<div class="image pos_abs" style="background-image:url(/project3/img/slide3.jpg)"></div>
				<img class="pos_abs bottom_image1" src="/project3/img/bottom_brown.png">
				<div class="pos_abs img2_wrapper">
					<img src="/project3/img/bottom_brown.png" class="bottom_image2 hidden" id="bottom_image2_3">
				</div>
				<div class="pos_abs img3_wrapper">
					<img src="/project3/img/top_brown.png" class="top_image1">
				</div>
				
				<div class="texts pos_abs">
					<h2>03</h2>
					<h3>FIND OUT, IT'S FREE</h3>
					<div class="separator"></div>
					<p>This product is open-source and it's completely free! Sign up (or sign in)
						now and enjoy!</p>
					<div class="see_project_wrapper">
						<a class="see_project" href="https://github.com/AnhtuTa/Javascript_Edumall"
						target="_blank">See project</a>
					</div>
				</div>
			</div>
		</div>

		<div class="slide_demo">
			<ul>
				<!-- Các giá trị của li phải là số thứ tự của slide.
				Nếu có, ví dụ, 7 slides thì cần 7 li -->
				<li class="active_slide" id="page_1">1</li>
				<li id="page_2">2</li>
				<li id="page_3">3</li>
			</ul>
		</div>
	</div>


<?php require('./footer.php') ?>
<script type="text/javascript">
	document.getElementById("menu_separator").style.display = "none";
</script>
<?php echo $this->Html->script('bai68.js');?>
</body>