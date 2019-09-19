<?php

class DB_CONNECT {

    public $mysql;

    function __construct() {
        require 'db_config.php';
        $this-> mysql = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    }

    function __destruct() {
        $this->mysql->close();
    }
}