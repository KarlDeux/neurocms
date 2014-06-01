<?php
abstract class Database {
    public static $instance;
    
    public abstract function connect($address, $databaseName, $user, $pw, $port = 3306);    
    
    public abstract function executeQuery($query);
    public abstract function executeStatement($statement);
    
    public abstract function autocommit($statement);
    public abstract function commit();
    
    public abstract function getErrNo();
    public abstract function getError();
    
    public static function inst() {
        return Database::$instance;
    }
}
