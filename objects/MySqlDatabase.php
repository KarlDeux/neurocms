<?php
include_once 'Database.php';

class MySqlDatabase extends Database {
    const MYSQL = 1;
    const MARIADB = 2;
    
    private $connection = null;
    private $type = 0;
    
    public function SqlDatabase($type = 1) {
        $this->type = $type;
        
        switch ($type) {
            case 1:
            case 2:
                break;
            default:
                break;
        }
    }
    
    public function connect($address, $databaseName, $user, $pw, $port = 3306) {
        $this->connection = new mysqli($address, $user, $pw, $databaseName, $port);
        
        if ($this->connection->connect_errno) {
            throw new Exception("Fallo al conectar a MySQL: (" . $this->connection->connect_errno . ") " . $this->connection->connect_error);
        }
    }
    
    public function executeQuery($query) {
        $result = $this->connection->query($query);
        
        if ($result === false) {
            throw new Exception("Fallo al ejecutar query:" . $query . " (" . $this->connection->connect_errno . ") " . $this->connection->connect_error);
        } else if ($result === true) {
            return null;
        } else {
           return $result;
        }
    }
    
    public function executeStatement($statement) {
        executeQuery($statement);
    }
    
    public function autocommit($statement = false) {
        $this->connection->autocommit($statement);
    }
    
    public function commit() {
        $this->connection->commit();
    }
    
    public function getErrNo() {
        return $this->connection->connect_errno;
    }
    
    public function getError() {
        return $this->connection->connect_error;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function _check_admin($username, $password) {
        $user_row = $this->connection->get_row("SELECT * FROM `user` WHERE `username`='" . escape($username) . "'");

        //general return
        if(is_object($user_row) && md5($user_row->password) == $password)
            return true;
        else
            return false;
    }
}
