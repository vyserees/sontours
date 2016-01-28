<?php

class Exploder extends Exploder_Abstract {
    
    public function explode() {
        
        return explode('/', (new Trimer)->trim());
        
    }
    
}

