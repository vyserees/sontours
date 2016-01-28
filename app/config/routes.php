<?php

$routes = array(
        'home'=>array(
            'controller'=>'home',
            'method'=>'index'
        ),
	'logauth'=>array(
            'controller'=>'home',
            'method'=>'logAuth'
        ),
        'logout'=>array('controller'=>'home', 'method'=>'logout'),
        'register'=>array(
            'controller'=>'home',
            'method'=>'register'
        ),
        'costs'=>array(
            'controller'=>'home',
            'method'=>'costs'
        ),
        'payment'=>array(
            'controller'=>'home',
            'method'=>'payment'
        ),
        'success'=>array('controller'=>'home','method'=>'success'),
        'enrollmentform'=>array('controller'=>'home','method'=>'enrollmentform'),
        'myprofile'=>array('controller'=>'participants','method'=>'index'),
    
        'leaders'=>array('controller'=>'groupleaders','method'=>'index'),
    
        'admin-main'=>array('controller'=>'admin','method'=>'index')
    
    
    
    /*ajax routes*/
        //'mailtogl'=>array('controller'=>'ajax','method'=>'mailtogl')
	);