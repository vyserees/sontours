<?php

class Model extends PDO{
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $chset = DB_CHARSET;
    
    public function __construct() {
        parent::__construct('mysql:host='.$this->host.';dbname='.$this->dbname.';charset='.$this->chset, $this->user, $this->pass, null);
    }
}

