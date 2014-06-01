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
$video_id = filter_input(INPUT_GET, "video_id", FILTER_SANITIZE_STRING);
$video_type = filter_input(INPUT_GET, "video_type", FILTER_SANITIZE_STRING);

$video = str_replace(array('http://vimeo.com/', 'http://youtu.be/'), array('', ''), $video_id);

if ($video_type == "vimeo") {
    $xml = simplexml_load_file("http://vimeo.com/api/v2/video/".$video.".xml");
    $xml = $xml->video;
    $xml_pic = $xml->thumbnail_large;
    $image = imagecreatefromjpeg($xml_pic);
    mkdir(__NEURO_BASE_URI__. "video/".$article);
    imagejpeg($image, __NEURO_BASE_URI__. 'video/'.$article.'/'.$article.'.jpg', 100);
}

if ($video_type == "youtube") {
    $image = imagecreatefromjpeg('http://img.youtube.com/vi/'.$video.'/hqdefault.jpg');
    mkdir(__NEURO_BASE_URI__. "video/".$article);
    imagejpeg($image, __NEURO_BASE_URI__. 'video/'.$article.'/'.$article.'.jpg', 100);
}

$db = new MySqlDatabase();
$db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

Database::$instance = $db;    

$db->autocommit(false);
$db->executeQuery("insert into " . _DB_PREFIX_ . "article (id, article_type, publisher, article_date) values ($article, '$video_type', 'default', '" . date('Y-m-d H:i:s') . "')");
$db->executeQuery("insert into " . _DB_PREFIX_ . "article_lang (id_lang, article_id, article_name, article_description) values (1, $article, '$title', '$description')");
$db->executeQuery("insert into " . _DB_PREFIX_ . "video (article_id, video_id) values ($article, '$video')");
$db->commit();

echo '<h1>The article was created successfully</h1>';

?>
