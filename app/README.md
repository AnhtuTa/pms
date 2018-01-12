# Project3_pms
Project management system

Project này dùng framework CakePHP 2.7.2
Cách cài đặt: 
1. Download CakePHP 2.7.2 về và giải nén ở thư mục cài xampp: htdocs
2. Cấu hình cho Cakephp, xem hướng dẫn tại: http://nongdanit.info/php-mysql/huong-dan-cai-dat-cakephp.html
Nếu ko cấu hình cũng đc vì t đã cấu hình rồi
3. Thay thế thư mục app trong thư mục CakePHP vừa giải nén bằng tất cả các file và thư mục ở đây
4. Cần cài đặt NodeJS express, socket.io
5. Cần tạo 1 database như trong script .sql
6. Done!

===========
Khi upload project lên host thật (VD: 000webhost) thì cần sửa 1 số chỗ như sau:
- trong file app/Config/database.php, trong biến $default sửa phần sau:
	'host' => 'localhost:3306',
	'login' => 'root',
	'password' => '5555',
	'database' => 'project3',
sửa thành cấu hình của database trên host thật

- trong file app/Controller/AppController.php, sửa phần sau:
	public $SERVER_NAME = "localhost:3306";
	public $USERNAME = "root";
	public $PASSWORD = "5555";
	public $DB_NAME = "project3";
cũng config như database trên host thật

- trong file app/Config/core.php có thể sửa:
	Configure::write('debug', 2);
thành:
	Configure::write('debug', 0);
để ko in giá trị debug ra màn hình

- Chú ý khi restore database từ mysql lên host thật:
	+ cần replace `root`@`localhost` thành `id3217876_root`@`%`	(id3217876_root là tài khoản trên phpmyadmin)
	+ cần replace `project3` thành `id3217876_project3`	(id3217876_project3 là tên database trên phpmyadmin)
	+ cần replace project3 thành id3217876_project3, trong đó project3 là tên database trong mysql, còn id3217876_project3 là tên database trên phpmyadmin (nếu trong 1 record có từ project3 thì ko cần replace nó)
	VD: trong mysql có đoạn sau: SELECT time FROM project3.comments...
	cần sửa thành: SELECT time FROM id3217876_project3.comments
