<?php

abstract class Controller {
    public abstract function showHeader();
    public abstract function showIndex($index, $data);
    public abstract function showFooter($js_arraw);
    public abstract function initialize();
    
    public function initializeDatabase() {
        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);
        
        Database::$instance = $db;
    }
    
    public function run($index, $js_array = false, $data = false) {
        $this->initialize();
        $this->showHeader();
        $this->showIndex($index, $data);
        $this->showFooter($js_array);
    }
}