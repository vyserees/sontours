<?php

class Url extends Url_Abstract {

    public function getUrl() {
        
        if (isset($_GET['uri'])) {
            return $_GET['uri'];
        }
         
    }

}
