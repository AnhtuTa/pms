<?php session_start(); ?>
<?php
class HomeController extends AppController {
	public function beforeRender() {
	    parent::beforeRender();
	    $this->layout = 'empty';
	}
	
	function index() {}
}