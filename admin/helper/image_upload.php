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

$db = new MySqlDatabase();
$db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

Database::$instance = $db;    

$db->autocommit(false);
$db->executeQuery("insert into " . _DB_PREFIX_ . "article (id, article_type, publisher, article_date) values ($article, 'image', 'default', '" . date('Y-m-d H:i:s') . "')");
$db->executeQuery("insert into " . _DB_PREFIX_ . "article_lang (id_lang, article_id, article_name, article_description) values (1, $article, '$title', '$description')");
$db->executeQuery("update " . _DB_PREFIX_ . "uploaded_files set thumbnail = 1 where file_name = '$thumbnail'");
$db->commit();

echo '<h1>The article was created successfully</h1>';

?>
