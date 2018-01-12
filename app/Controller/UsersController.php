<?php session_start(); ?>
<?php require('./DateUtils.php') ?>
<?php
	
?>

<?php
class UsersController extends AppController {
	public $name = "Users"; // tên của Controller User
	public $components = array('Session');

	public function beforeRender() {
	    parent::beforeRender();
	    $this->layout = 'my_layout';
	}

	function index() {}
	function info() {}

	function login() {
		$error = "";
		if(isset($_POST['btnLogin'])) {
			$user = $_POST['username'];
			$pass = md5($_POST['password']);

			// check xem người dùng đã đc quyền login hay chưa (nếu như trước đó họ đã login sai 3 lần)
			$sql_check_10min = "SELECT wrong_pass_3_times FROM users
								WHERE id = '".$user."'";
			$kq = $this->User->query($sql_check_10min);
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			//$last_wrong_pw_3_times = $kq[0]['users']['wrong_pass_3_times'];
			$timePass = time() - strtotime($kq[0]['users']['wrong_pass_3_times']);
			if($timePass < 10*60) {
				$timeLeft = 10*60 - $timePass;
				$min = floor($timeLeft/60);
				$min > 1 ? ($min.=" mins") : ($min.=" min");
				$sec = $timeLeft%60;
				$this->set("error", "<b>Can't login!</b> This account has been trying to login with 3 times incorrect password.<br>Please wait after 10 minutes to login again!<br><br><b>Time left: ".$min." ".$sec." s</b>");
				if(isset($_SESSION['num_of_incorrect_pass'])) $_SESSION['num_of_incorrect_pass'] = 0;
				return;
			}
			//echo myFriendlyDate($last_wrong_pw_3_times)."<br>";
			
			//echo "<br>".$kq[0]['users']['wrong_pass_3_times'];

			if($this->User->checkLogin($user, $pass)) {
				$infoString = "Đăng nhập thành công roài!<br> Click <a href='info'>vào đây</a> để xem thông tin của bạn!";
				$this->set("infoString", $infoString);	// giống request.setAttribute("infoString", $infoString) trong JSP. Và bên file login.ctp sẽ sử dụng = cách echo cái biến $infoString là xong!

				if($_SESSION['userRole'] == 2) {
					// redirect to users/info immediately
					// header("Location: "."http://$_SERVER[HTTP_HOST]"."/project3"."/users/info");
					// die();
					echo "<script type='text/javascript'>
						var STR_MY_WEBSITE = location.protocol + '//' + location.hostname + (location.port ? (':' + location.port) : '') + '/project3';
						window.location = STR_MY_WEBSITE + '/users/info';
					</script>";
					die();
				} else {
					// header("Location: "."http://$_SERVER[HTTP_HOST]"."/project3"."/tasks/show_all_tasks");
					// die();
					echo "<script type='text/javascript'>
						var STR_MY_WEBSITE = location.protocol + '//' + location.hostname + (location.port ? (':' + location.port) : '') + '/project3';
						window.location = STR_MY_WEBSITE + '/tasks/show_all_tasks';
					</script>";
				}
				if(isset($_SESSION['num_of_incorrect_pass'])) $_SESSION['num_of_incorrect_pass'] = 0;
			} else {
				$error = "Username or password is wrong. Try again!";
				$this->set("error", $error);
				if(!isset($_SESSION['num_of_incorrect_pass'])) $_SESSION['num_of_incorrect_pass'] = 1;
				else {
					$_SESSION['num_of_incorrect_pass']++;
					echo "num_of_incorrect_pass = ".$_SESSION['num_of_incorrect_pass']."<br>";
					if($_SESSION['num_of_incorrect_pass'] == 3) {
						// try to enter incorrect password 3 times! Lock this account for 20 minutes!
						$sql_incorrect_pw = "UPDATE `users` SET `wrong_pass_3_times` = now() WHERE `id`='".$user."';";
						$this->User->query($sql_incorrect_pw);
						
						echo "3 times incorrect password!!!";
						$_SESSION['num_of_incorrect_pass'] = 0;
					}
				}
			}
		}
	}

	function logout() {
		session_unset();
	    session_destroy();
	}

	function add_student() {
		if(isset($_POST['btn_submit'])) {
			$user = $_POST['txt_user'];
			$pass = $_POST['txt_pass'];
			$name = $_POST['txt_name'];
			try {
				$sql = "INSERT INTO users(id, password, name, role) VALUES ('".$user."', '".md5($pass)."', '".$name."', '2')";
				$this->User->query($sql);
				$this->set("infoString", "<h3>Create new account successful!</h3><div>Username: $user</div><div>Password: $pass</div><div>Student's name: $name</div>");
			} catch (Exception $e) {
				//echo "Exception: ".$e->getMessage();
				$this->set("user", $user);
				$this->set("pass", $pass);
				$this->set("name", $name);
				
				if ((strpos($e->getMessage(), 'PRIMARY') !== false) && (strpos($e->getMessage(), 'Duplicate entry') !== false)) {
					$this->set("errorString", "<h3 class='error_string'>Error: this username has been exist!</h3>");
				} else {
					$this->set("errorString", "<h3 class='error_string'>An unknown error happend!</h3>");
				}
			}
			
		}
	}

	function edit_info() {
		if(isset($_POST['btn_save'])) {
			$newName = $_POST['txt_name'];
			$sql = "UPDATE users SET `name`='". $newName ."' WHERE `id`='".$_SESSION['userId']."';";
			$this->User->query($sql);
			$_SESSION['userName'] = $newName;
			$_SESSION['changeNameStatus'] = 1;
			// header("Location: info");
			// die();

			echo "<script type='text/javascript'>
					var STR_MY_WEBSITE = location.protocol + '//' + location.hostname + (location.port ? (':' + location.port) : '') + '/project3';
					window.location = STR_MY_WEBSITE + '/users/info';
				</script>";
			die();
		}
	}

	function change_password() {
		if(isset($_POST['btn_submitOldPass'])) {
			$oldPass = $_POST['txt_oldPass'];
			$sql_oldPass = "SELECT * FROM users WHERE id = '".$_SESSION['userId']."' AND password = '".md5($_POST['txt_oldPass'])."'";
			$kq = $this->User->query($sql_oldPass);
			if(count($kq) == 0) {
				$this->set("errorString", "Error! Wrong password!!!");
			} else {
				$this->set("oldPasswordValid", 1);
			}
		}

		if(isset($_POST['btn_save'])) {
			$newPass1 = $_POST['txt_newPass1'];
			$newPass2 = $_POST['txt_newPass2'];
			if($newPass1 != $newPass2) {
				$this->set("errorString2", "Passwords don't match!!!");
				$this->set("oldPasswordValid", 1);
				$this->set("newPass1", $newPass1);
				$this->set("newPass2", $newPass2);
			} else {
				$sql_changePass = "UPDATE users SET `password`='".md5($newPass1)."' WHERE `id`='".$_SESSION['userId']."';";
				$this->User->query($sql_changePass);
				$_SESSION['changePassStatus'] = 1;
				// header("Location: info");
				// die();
				echo "<script type='text/javascript'>
					var STR_MY_WEBSITE = location.protocol + '//' + location.hostname + (location.port ? (':' + location.port) : '') + '/project3';
					window.location = STR_MY_WEBSITE + '/users/info';
				</script>";
				die();
			}
		}
	}
}