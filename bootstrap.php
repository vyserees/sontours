<?php
define('MVC_PATH', dirname(__FILE__));
define('APP_PATH', MVC_PATH . '/app/');
if (!isset($_SESSION)) {
    session_start();
}
//if (DEBUG === TRUE) {   
//    ini_set('display_errors', 1);
//    error_reporting(E_ALL ^ E_STRICT);
//} else {
//    ini_set('display_errors', 0);
//    error_reporting(0);
//}
require_once APP_PATH . 'config/config.php';
require_once APP_PATH . 'config/db.php';
date_default_timezone_set(APP_TIMEZONE);
function class_autoloader($class_name) {
       $name = strtolower($class_name);
        $possible_locations = array(
            APP_PATH . 'controllers/' . $name . '.php',
            APP_PATH . 'models/' . $name . '.php',
            APP_PATH . 'core/mvc/' . $name . '.php',
            APP_PATH . 'core/mvc/abstract/' . $name . '.php',
            APP_PATH . 'core/mvc/helper/' . $name . '.php',
            APP_PATH . 'core/mvc/router/' . $name . '.php',
            APP_PATH . 'core/db/' . $name . '.php',
            APP_PATH . 'core/controller/' . $name . '.php',
            APP_PATH . 'core/model/' . $name . '.php',
        );
        foreach ($possible_locations as $location) {
            if (file_exists($location)) {
                require_once $location;
                return TRUE;
            }
        }
    }
spl_autoload_register('class_autoloader');
require_once 'functions.php';


