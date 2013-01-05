<?php

/**
 * Array that holds data for various parts of the web app - database, config options, etc.
 */

$config = array(
	'databases'	=> array(
		'ESA'	=> array(
			'database'	=> 'esa',
			'username'	=> 'ESA',
			'password'	=> 'esapassword',
			'host'		=> 'localhost'
		)
	),
	'urls'	=> array(
		'baseURL' => $_SERVER['SERVER_NAME']
	),
	'topNav' => array(
		'Home' => 'home/', 
		'Members' => 'members/',
		'Groups' => 'groups/'
	)
);

/**
 * Error reporting
 */

ini_set('error_reporting', 'true');
error_reporting(E_ALL|E_STRCT);

defined('DS')
	or define('DS', DIRECTORY_SEPARATOR);

/**
 * App path and its subdirectories
 */

defined('APP_PATH')
	or define('APP_PATH', realpath(dirname(__FILE__) . DS . '..'));

defined('CONFIG_PATH')
	or define('CONFIG_PATH', realpath(dirname(__FILE__)));

defined('DOC_ROOT')
	or define('DOC_ROOT', realpath(CONFIG_PATH . '..' . DS . '..' . DS . '..'));

defined('PUBLIC_PATH')
	or define('PUBLIC_PATH', realpath(APP_PATH . DS . 'public'));

defined('OBJECTS_PATH')
	or define('OBJECTS_PATH', realpath(APP_PATH . DS . 'objects'));

defined('LAYOUTS_PATH')
	or define('LAYOUTS_PATH', realpath(APP_PATH . DS . 'layouts'));

/**
* Bootstrap path and its subdirectories
*/

defined('BOOTSTRAP_UI_PATH')
	or define('BOOTSTRAP_UI_PATH', realpath(PUBLIC_PATH . DS . 'bootstrap'));

defined('BOOTSTRAP_UI_CSS_PATH')
	or define('BOOTSTRAP_UI_CSS_PATH', realpath(BOOTSTRAP_UI_PATH . DS . 'css'));

defined('BOOTSTRAP_UI_JS_PATH')
	or define('BOOTSTRAP_UI_JS_PATH', realpath(BOOTSTRAP_UI_PATH . DS . 'js'));

/** 
 * Core path and its subdirectories
 */
defined('CORE_PATH')
	or define('CORE_PATH', realpath(DOC_ROOT . DS . 'core'));

defined('UTILS_PATH')
	or define('UTILS_PATH', realpath(CORE_PATH . DS . 'utils'));

defined('STRUCTURES_PATH')
	or define('STRUCTURES_PATH', realpath(CORE_PATH . DS . 'structures'));

defined('HELPERS_PATH')
	or define('HELPERS_PATH', realpath(CORE_PATH . DS . 'helpers'));

defined('DATASOURCES_PATH')
	or define('DATASOURCES_PATH', realpath(CORE_PATH . DS . 'datasources'));

defined('COMPONENTS_PATH')
	or define('COMPONENTS_PATH', realpath(CORE_PATH . DS . 'components'));

defined('LOGS_PATH')
	or define('LOGS_PATH', realpath(APP_PATH . DS . 'logs'));

/**
* Page requests
*/

defined('REQUESTED_PAGE')
	or define('REQUESTED_PAGE', isset($_GET['page']) ? $_GET['page'] : 'home');
	
defined('REQUESTED_FILTER')
	or define('REQUESTED_FILTER', isset($_GET['filter']) ? $_GET['filter'] : 'all members');

defined('REQUESTED_REDIRECT')
	or define('REQUESTED_REDIRECT', isset($_SESSION['redirect']) ? $_SESSION['redirect'] : false);

defined('EDIT_REQUEST')
	or define('EDIT_REQUEST', isset($_GET['edit']) ? $_GET['edit'] : false);

defined('LOGIN_ERROR')
	or define('LOGIN_ERROR', isset($_GET['loginError']) ? $_GET['loginError'] : false);

/**
* Database information
*/

/** Name of the database */
defined('DB_NAME')
	or define('DB_NAME', 'genassem');

/** Name of the user to access the database */
defined('DB_USER')
	or define('DB_USER', 'genassem');

/** Password used to access the database */
defined('DB_PASSWORD')
	or define('DB_PASSWORD', 'bQE2VrcXFqEVNzEM');

/** Host of the database */
defined('DB_HOST')
	or define('DB_HOST', 'localhost');