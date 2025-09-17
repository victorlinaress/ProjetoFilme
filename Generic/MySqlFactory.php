<?php
namespace Generic;

class MySqlFactory{
    public MysqlSingleton $banco;
    public function __construct(){
        $this->banco = MysqlSingleton::getInstance();
    }
}