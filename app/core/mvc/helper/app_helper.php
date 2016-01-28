<?php

class App_Helper {
    
    //public function routesPath() {
        
    //    ob_start();
        
    //    include_once APP_PATH . 'config/routes.php';
        
    //    return ob_get_contents();
        
    //}
    
    public function emptyUrl($url) {
        
        return empty($url);
        
    }
    
    public function urlKeyPresent($url, $routes) {
        
        return array_key_exists($url, $routes) ;
        
    }
    
    public function urlKeySearch($url, $keys) {
        
        return array_search($url, $keys);
        
    }
    
    public function urlKey($routes) {
        
        return array_keys($routes);
        
    }    
}

