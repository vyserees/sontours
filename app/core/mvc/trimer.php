<?php

class Trimer extends Trimer_Abstract {
    
    public function trim() {
        
        return rtrim((new Url)->getUrl(), '/');
        
    }
    
}

