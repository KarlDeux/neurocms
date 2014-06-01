<?php

include_once('../config/base.config.php');
include_once('../config/definitions.config.php');
include_once('../config/smarty.config.php');
include_once('Tools.php');
include_once('MySqlDatabase.php');

class Admin {

    public function _authenticate($login = false) {
        if (!$login) {
        //first check whether session is set or not
            if (!isset($_SESSION['admin_login'])) {
                //check the cookie
                if (!isset($_COOKIE['neuro_cms_admin'])) {
                    header("location: login.php");
                    die();
                } else {
                    return true;
                }
            }
        }
    }

    function _check_db($username, $password) {
        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

        Database::$instance = $db;

        $query = "select * from " . _DB_PREFIX_ . "admin where username = '$username' and password = '$password'";

        $result = $db->executeQuery($query);

        return $result ? true : false;
    }

}