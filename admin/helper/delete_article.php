<?php
include_once('../../config/base.config.php');
include_once('../../config/definitions.config.php');
include_once('../../config/smarty.config.php');
include_once('../../objects/Tools.php');
include_once('../../objects/CSSmin.php');
include_once('../../objects/Exception.php');
include_once('../../objects/MySqlDatabase.php');

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$db = new MySqlDatabase();
$db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

Database::$instance = $db;    

$db->autocommit(false);
$db->executeQuery("delete from " . _DB_PREFIX_ . "article where id = $id");
$db->executeQuery("delete from " . _DB_PREFIX_ . "article_lang where article_id = $id");
$db->executeQuery("delete from " . _DB_PREFIX_ . "uploaded_files where folder = $id");
$db->executeQuery("delete from " . _DB_PREFIX_ . "video where article_id = $id");
$db->commit();

deleteDir(__NEURO_BASE_URI__. "video/".$id);
deleteDir(__NEURO_BASE_URI__. "admin/uploader/server/php/files/".$id);

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}