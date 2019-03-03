<?php
//dinh nghia
//mongod.exe --config D:\mongodb\config.txt

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
ini_set('memory_limit', -1);
ini_set('mongo.long_as_object', 1);
error_reporting(-1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Ho_Chi_Minh');
define('APPLICATION_PATH', realpath(dirname(__DIR__)));
define('PYTHON_PATH', APPLICATION_PATH . '/apps/python/');
define('LIBRARY_PATH', APPLICATION_PATH . '/apps/library/');
define('FILE_PATH', APPLICATION_PATH . '/public/files/');

define('PUBLIC_URL', '/');
define('PUBLIC_URL1', '');
define('ADMIN_URL', '/backend/');
define('PUBLIC_TEMPLATES_URL', '/templates/admin/');
define('IMPORT_PATH', APPLICATION_PATH . '/apps/data/');

define('API_KEY', 'ureka');
defined('DS') || define('DS', DIRECTORY_SEPARATOR);


function dd($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}