<?php
include_once('../../config/base.config.php');
include_once('../../config/definitions.config.php');
include_once('../../config/smarty.config.php');
include_once('../../objects/Tools.php');
include_once('../../objects/CSSmin.php');
include_once('../../objects/Exception.php');
include_once('../../objects/MySqlDatabase.php');

$title = nl2br(filter_input(INPUT_GET, "title", FILTER_SANITIZE_STRING));
$description = nl2br(filter_input(INPUT_GET, "description", FILTER_SANITIZE_STRING));
$article = filter_input(INPUT_GET, "article", FILTER_SANITIZE_NUMBER_INT);
$thumbnail = filter_input(INPUT_GET, "thumbnail", FILTER_SANITIZE_STRING);
$video_id = filter_input(INPUT_GET, "video_id", FILTER_SANITIZE_STRING);
$video_type = filter_input(INPUT_GET, "video_type", FILTER_SANITIZE_STRING);

$video = str_replace(array('http://vimeo.com/', 'http://youtu.be/'), array('', ''), $video_id);

$db = new MySqlDatabase();
$db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

Database::$instance = $db;  

$db->executeQuery("update " . _DB_PREFIX_ . "uploaded_files set thumbnail = 0 where folder = $article");

$db->autocommit(false);
$db->executeQuery("update " . _DB_PREFIX_ . "article set article_type = '" . ($video_type ? $video_type :  'image') . "', publisher = 'default', article_date = '" . date('Y-m-d H:i:s') . "' where id = $article");
$db->executeQuery("update " . _DB_PREFIX_ . "article_lang set id_lang = 1, article_name = '$title', article_description = '$description' where article_id = $article");
$db->executeQuery("update " . _DB_PREFIX_ . "uploaded_files set thumbnail = 1 where file_name = '$thumbnail'");
$db->executeQuery("update " . _DB_PREFIX_ . "video set video_id = '$video' where article_id = $article");
$db->commit();

echo '<h1>The article was updated successfully</h1>';

?>
