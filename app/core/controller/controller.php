<?php

abstract class Controller {

    public abstract function index();
    
    public static function model($model){
        $file = APP_PATH . 'models/' . $model . '.php';
	if (class_exists(ucfirst($model)) && file_exists($file)) {
		return (new $model);
	}
    }
    public static function view($view, $data = NULL, $c=null) {
	$file = APP_PATH . 'views/' . $view . '.php';
	if (file_exists($file)&&null===$c) {
            include_once APP_PATH.'/inc/header.php';
            include_once $file;
            include_once APP_PATH.'/inc/footer.php';
	}elseif(file_exists($file)&&null!==$c){
            include_once $file;
        }
    }

}
