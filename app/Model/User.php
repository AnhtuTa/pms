<?php
class User extends AppModel {
    var $name = "User";//tên của model

    function checkLogin($u, $p) {
    	$sql = "SELECT * FROM users WHERE id = '$u' AND password = '$p'";
    	$data = $this->query($sql);
    	//var_dump($data);
    	//print_r($data);
    	//echo "role = ".$data[0]['users']['role'];

    	if($this->getNumRows() == 0) {
    		return false;
    	} else {
    		$_SESSION['userRole'] = $data[0]['users']['role'];
    		$_SESSION['userId'] = $data[0]['users']['id'];
            $_SESSION['userName'] = $data[0]['users']['name'];
            
            set_time_limit(60);
    		return true;
    	}
    }
}