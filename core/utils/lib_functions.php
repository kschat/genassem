<?php

function printArray($arr) {
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

/**
* Functions used to get around the glitch in explode
*/
function explode_filtered_empty($var) { 
	if ($var == "") {
		return(false);
	}
		
	return(true); 
} 

function explode_filtered($delimiter, $str) { 
	$parts = explode($delimiter, $str); 
	return(array_filter($parts, "explode_filtered_empty")); 
}

function appendToUrl($query = array(), $uri = '') {
	$url = empty($uri) ? $_SERVER['HTTP_HOST'] : $uri;
	$query = is_string($query) ? array($query) : $query;

	foreach ($query as $key => $value) {
		if(is_numeric($key)) {
			$url .= '/' . $value;
		}
		else {
			$url .= '/' . $key . '/' . $value;
		}
	}

	return 'http://'.$url;
}

/*
* Creates a url based on the domain name, and the argument passed into the function
*/
function buildUrl($queries) {
	$url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$queries;
	$parts = parse_url($url);
	
	/*
	echo '<pre>';
	print_r($parts);
	echo '</pre>';
	*/
	
	return http_build_url($parts);
}

/*
* Creates a url by appending whatever is passed in to the function and determining if it's 
* already apart of the url. If it is don't add it, else add it to the url.
*/
function appendUrl($queries) {
	$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$parts = parse_url($url);
	$uri = explode_filtered('/', $parts['path']);
	$queries = explode_filtered('/', $queries);
	$temp = '';
	
	//Filter out matching values
	foreach($queries as $key => $query) {
		foreach($uri as $value) {
			if($query == $value) {
				unset($queries[$key]);
			}
		}
		$temp .= (isset($queries[$key])) ? $queries[$key] : '';
	}
	
	$parts['path'] .= (substr($parts['path'], -1) == '/') ? $temp : '/'.$temp;
	
	return http_build_url($parts);
}

/*
* Gets the page name without any slashes
*/
function parsePageName($p) {
	$temp = explode('/', $p);
	$temp = explode('.', $temp[count($temp)-1]);
	
	return $temp[0];
}

/*
* Gets the php file with the same name as p. If there is no php file by that name then
* include the page not found file.
*/
function getPage($p) {
	$temp = parsePageName($p);
	$page = OBJECTS_PATH . DS . $temp . DS . 'views' . DS . $temp . '.php';
	
	if(file_exists($page)) {
		include($page);
	}
	else {
		include(OBJECTS_PATH . DS . 'page-not-found' . DS . 'views' . DS . 'pageNotFound.php');
	}
}

function getView($object, $view) {
	$page = OBJECTS_PATH . DS . $object . DS . 'views' . DS . $view;
	
	//if(file_exists($page)) {
		include($page);
	//}
}

function formatImage($url) {
	return "<img class=\"avatarSmall\" src=\"$url\" />";
}

/*
* See's if there is a mapping for the value passed into the function in $config['mapping'] 
*/
function mapValue($value) {
	global $config;
	if(isset($config['mapping'][$value])) {
		return $config['mapping'][$value];
	}
	
	return $value;
}

//Checks the priviledges of the user logged in.
function checkPriviledges() {
	if(isset($_SESSION['loggedIn']) && isset($_SESSION['privileges'])) {
		return $_SESSION['privileges'];
	}
	
	return 'none';
}

function tableViewQuery($viewName, $tbView) {
	$query = 'CREATE VIEW  ' . $viewName . ' AS SELECT ';
	foreach ($tbView as $column) {
		$query .= $column['table_name'] . '.' . $column['column_name'] . ', ';
	}

	$query = substr($query, 0, -2).' FROM users';

	return $query;
}