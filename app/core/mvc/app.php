<?php

class App extends App_Abstract {

    private $_router = ROUTER;

    public function initialize() {

        if ($this->_router == TRUE) {

            (new Router)->customRoutes();
        } else {

            (new Router)->defaultRoutes();
        }
    }

}
