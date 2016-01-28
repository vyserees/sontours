<?php

class Router {

    private $_routes = 'config/routes.php';
    private $_app_path = APP_PATH;
    private $_route;
    private $_routes_Array;
    private $_uri;
    private $_rtrim;
    private $_explode;
    private $_controller;
    private $_method;
    private $_params;
    private $_index_Method = "index";
    private $_route_Search;
    private $_array_Keys;

    public function customRoutes() {
        require_once $this->_app_path . $this->_routes;
        $this->_routes_Array = $routes;
        $this->_uri = (new Exploder)->explode();
        if ((new App_Helper)->emptyUrl($this->_uri[0])) {
            $this->_controller = new Home;
            $this->_method = $this->_index_Method;
        }
        if ((new App_Helper)->urlKeyPresent($this->_uri[0], $this->_routes_Array)) {
            $this->_route = (new Routing)->getRoute($this->_routes_Array, $this->_uri[0]);
            $this->_controller = $this->_route['controller'];
            $this->_method = $this->_route['method'];
        }
        $this->_route_Search = (new App_Helper)->urlKeySearch($this->_uri[0], (new App_Helper)->urlKey($this->_routes_Array));
        $this->_array_Keys = (new App_Helper)->urlKey($this->_routes_Array)[$this->_route_Search];
        if (!(new App_Helper)->emptyUrl($this->_uri[0]) && strcmp($this->_array_Keys, $this->_uri[0]) !== 0) {
            $this->_controller = new Error;
            $this->_method = $this->_index_Method;
        }
        $this->_params = array_slice($this->_uri, 1);
        @call_user_func_array(array($this->_controller, $this->_method), $this->_params);
    }

    public function defaultRoutes() {

        $this->_uri = (new Exploder)->explode();
        if (empty($this->_uri[0])) {
            $this->_controller = new Home;
            $this->_method = $this->_index_Method;
        }
        if (isset($this->_uri[0]) && class_exists($this->_uri[0]) && method_exists($this->_uri[0], $this->_index_Method)) {
            $this->_controller = $this->_uri[0];
            $this->_method = $this->_index_Method;
            isset($this->_uri[0]) && method_exists($this->_uri[0], $this->_uri[1]) ? $this->_method = $this->_uri[1] : '';
        }
        if (!empty($this->_uri[0]) && !class_exists($this->_uri[0]) || !empty($this->_uri[1]) && !method_exists($this->_uri[0], $this->_uri[1])) {
            $this->_controller = new Error;
            $this->_method = $this->_index_Method;
        }
        $this->_params = array_slice($this->_uri, 2);
        call_user_func_array(array($this->_controller, $this->_method), $this->_params);
    }

}
