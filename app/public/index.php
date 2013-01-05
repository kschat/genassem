<?php
/**
* Include bootstrapping files and files essential to run the app.
*/
include_once '../config/config.php';
include_once UTILS_PATH . DS . 'lib_functions.php';
include_once STRUCTURES_PATH . DS . 'template.php';
include_once UTILS_PATH . DS . 'database' . DS . 'MemberDatabaseHandler.class.php';

$dbh = new MemberDatabaseHandler(DB_NAME, DB_HOST, DB_USER, DB_PASSWORD);

//Create a template object that is used to render the app
$index = new Template('index.view.php', 'index', array(
	'title' 	=> 'GenAssem',
	'header'	=> new Template('header.view.php', 'header'),
	'body' 		=> new Template('main-container.view.php', 'main-container')
	)
);

//Render the app
$index->render();

printArray($dbh->getMembers());