<?php
// Load yNew factory
include_once('../ynew.php');

// Changing classes folder
yNew::$path = 'examples';
// Getting class instance and calling it's method
echo yNew::create('foo')->getParam();

?>