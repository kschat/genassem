<?php

spl_autoload_register('AppAutoLoader::ControllerLoader');
spl_autoload_register('AppAutoLoader::ModelLoader');

include_once 'config.php';

class AppAutoLoader {
	
	public static function ControllerLoader($className) {
		$objectName = explode('_', $className);
		$path = OBJECTS_PATH . DS . $objectName[0] . DS . $objectName . '_Controller.class.php';

		if(file_exists($path)) {
			echo $path;
			include_once $path;
		}
	}

	public static function ModelLoader($className) {
		$objectName = explode('_', $className);
		$path = OBJECTS_PATH . DS . $objectName[0] . DS . $className . '.class.php';

		if(file_exists($path)) {
			include_once $path;
		}
	}
}