<?php
// Load yNew factory
include_once('../ynew.php');

// Getting new instance of examples_foo_bar from /examples/foo/bar.php
$fooBar = yNew::create('examples_foo_bar');
// Echoing examples_foo_bar's method result
echo $fooBar->getParam();

// You can do that in one string
echo yNew::create('examples_foo_bar')->getParam();

// Or without yNew
include_once('foo/bar.php');
$fooBar = new examples_foo_bar();
echo $fooBar->getParam();

?>