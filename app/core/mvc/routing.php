<?php

class Routing extends Routing_Abstract {
    
    public function getRoute($array, $index) {
        $arrayIt = new RecursiveArrayIterator($array);
        $it = new RecursiveIteratorIterator(
                $arrayIt, RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($it as $key => $value) {
            if ($key == $index) {
                return $value;
            }
        }
        return null;
    }
    
}

