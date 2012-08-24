<?php

class examples_foo_bar {
	public $param = 'param value<br />';
	
	public function __construct() {
		echo 'examples_foo_bar class constructed<br />';
	}

	public function getParam() {
		return $this->param;
	}
}

?>