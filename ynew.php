<?php //defined ('_YEXEC')  or  die('Restricted access');
/** \file factory.php
 *  \author Roman Exempliarov
 *  \version 0.1
 * Contains yNew class
 */

class yNew {
	public $directory = '/';
	public static
		$basePath,
		$path,
		//$altPaths,
		$delimiter = '_',
		$extension = 'php',
		$allowMagic = true;		// Allows sending class name as static method name

	public static function __callStatic($method, $arguments) {
		if(static::$allowMagic)
			return static::createArgs($method, $arguments);
		else
			throw new Exception("Missing static method '$method'.");
	}

/** Creates class $className instance.
 * @param string $className Name of class
 * @param array $arguments (optional) Arguments for $className constructor
 */
	public static function createArgs($class, $arguments = NULL) {
		static::load($class);

		// Return class instance
		if (empty($arguments))
			return new $class();
		else { // If arguments are set pass them to constructor
			$classReflection = new ReflectionClass($class);
			return $classReflection->newInstanceArgs($arguments);
		}
	}

/** Creates class $class instance.
 * @param string $class Name of class
 * @param mixed $argument1 (optional) First argument for constructor
 * @param mixed $argument2 (optional) Second argument for constructor
 * @param mixed (...)
 */	
	public static function create($class) {
		$arguments = func_get_args();
		array_shift($arguments);
		return static::createArgs($class, $arguments);
	}

/** Adds static::load() to autoload.
 */
	public static function autoload() {
		$factory = get_called_class();
		spl_autoload_register(
			function($class) use ($factory) {
				try {
					$factory::load($class);
				} catch (Exception $e) {}
			},
			false
		);
	}

/** Includes file with class $className if class doesn't defined yet.
 * @param string $class Name of class
 * @param string $componentPath (optional) Path to file with class relatively to framework root
 * @return string $componentPath or NULL if class already defined
 */
	public static function load($class) {
		// Return if class exists
		if(class_exists($class))
			return false;

		$fullPath = static::classPath($class);
	
		if(!@include_once($fullPath))
			throw new Exception("Can't load class \"$class\" from \"$fullPath\".");

		return $fullPath;
	}
		
	/// Returns path to $class depending on class settings
	public static function classPath($class) {
		if(!isset(static::$basePath)) static::$basePath = __dir__;

		if(isset(static::$delimiter)) {
			$exploded = explode(static::$delimiter, $class);
			$fileName = array_pop($exploded);
			$classPath = (!empty($exploded) ? implode('/', $exploded) : $fileName);
		} else {
			$classPath = $class;
			$fileName = $class;
		}
		
		return
			static::$basePath.
			(static::$path ? '/'.static::$path : '').
			($classPath ? '/'.$classPath : '').
			'/'.$fileName.
			'.'.static::$extension;		
	}
}

/*
 * This is yNew factory class.
 *
 * Copyright (C) 2012 Roman Exempliarov. 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

?>