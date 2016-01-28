<?php

$auxilium = array();
$auxilium['APP_NAME'] = 'Son Tours inc';
$auxilium['APP_URL'] = 'http://www.son-tours.dev/';
$auxilium['APP_TIMEZONE'] = 'Europe/Belgrade';
//$auxilium['DEBUG'] = TRUE;
$auxilium['ROUTER'] = TRUE;

foreach ($auxilium as $constant => $value) {
    
    define($constant, $value);
    
}
 

