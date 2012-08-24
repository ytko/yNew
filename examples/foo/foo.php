<?php

class foo {
	public $param = 'param value<br />';
	
	public function __construct() {
		echo 'foo class constructed<br />';
	}

	public function getParam() {
		return $this->param;
	}
}

?>