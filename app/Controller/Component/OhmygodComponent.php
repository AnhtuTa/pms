<?php 
class OhmygodComponent extends Component {
	// public function initialize(Controller $controller) {
 //       	echo "this is init()";
	// 	parent::initialize();
	// 	$this->viewBuilder()->layout('my_layout');
 //    }


    function initialize($controller, $settings = array()) {
		$this->controller = &$controller;
		//Su dung OhmygodComponent ngoài view
		$this->controller->set('Dataview_ThisIsJustAName', new OhmygodComponent());
	}

	function startup($controller) {}	//$controller là controller sử dụng thằng component này. Trong VD này là BooksController
	function beforeRender($controller) {}
	function shutdown($controller) {}
	function beforeRedirect(&$controller, $url, $status=null, $exit=true) {}
	function redirectSomewhere($value) {}

}
?>