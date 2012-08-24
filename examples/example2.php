<?php
// Load yNew factory
include_once('../ynew.php');

// Changing classes folder
yNew::$classesPath = 'examples';
// Getting class instance and calling it's method
echo yNew::foo()->getParam();

// Now we set classes folder back
yNew::$classesPath = '';
// And difine yNew extension
class myNew extends yNew {
	public static $classesPath = 'examples';
}
// Now we can use our new class in the same way
echo myNew::foo()->getParam();

?>