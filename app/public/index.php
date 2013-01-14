<?php
/**
* Include bootstrapping files and files essential to run the app.
*/
include_once '../config/config.php';
include_once CONFIG_PATH . DS . 'autoloader.php';
include_once UTILS_PATH . DS . 'lib_functions.php';
include_once CORE_PATH . DS . 'Model.class.php';
include_once CORE_PATH . DS . 'View.class.php';
include_once UTILS_PATH . DS . 'database' . DS . 'ComponentDatabaseHandler.class.php';

$dbh = new ComponentDatabaseHandler(DB_NAME, DB_HOST, DB_USER, DB_PASSWORD);
$components = array();

/** Runs through each component for the page and adds them to the page array. */
foreach ($dbh->getComponentsForPage('landing_page') as $key => $value) {
	$controller = $value['component_name'].'_Controller';
	$model = $value['component_name'].'_Model';
	$model = new $model();
	$view = new BaseView($value['component_name'] . '.view.php', $value['component_name']);
	$components[$key] = new $controller($model, $view);
}

$indexModel = new Index_Model(REQUESTED_PAGE, array('title' => 'GenAssem - ' . REQUESTED_PAGE, 'components' => $components));
$indexView = new BaseView('index.view.php', 'Index');

$indexController = new Index_Controller($indexModel, $indexView);
$indexController->addController('header', new BaseModel(), new BaseView('header.view.php', 'header'));

$indexController->renderViews();
$indexController->invokeAll();