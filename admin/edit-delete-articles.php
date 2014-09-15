<?php 

include_once('../controller/BackEndController.php');
include_once('../objects/Admin.php');
$admin = new Admin();
$admin->_authenticate();

$js_array = array();
array_push($js_array, 'js/edit-delete-articles.js');

$db = new MySqlDatabase();
$db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

Database::$instance = $db;    

$i = 0;
$article = array();

$query = "select 
    a.id,
    a.article_type,
    b.article_name,
    ifnull(d.file_name, '') as file_name,
    ifnull(e.video_id, '') as video_id
from
    " . _DB_PREFIX_ . "article as a
        inner join
   " . _DB_PREFIX_ . "article_lang as b ON a.id = b.article_id
        left join
    (select 
        c.file_name, c.folder
    from
        " . _DB_PREFIX_ . "uploaded_files as c
    where
        c.thumbnail = 1) as d ON a.id = d.folder
        and a.article_type = 'image'
    left join
        " . _DB_PREFIX_ . "video as e ON a.id = e.article_id
order by a.id desc";

$result = $db->executeQuery($query);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $article[$i] = array();
    $article[$i]['id'] = $row['id'];
    $article[$i]['article_type'] = $row['article_type'];
    $article[$i]['article_name'] = $row['article_name'];
    $article[$i]['file_name'] = $row['file_name'];
    $article[$i]['video_id'] = $row['video_id'];
    $i++;
}

try {
    $index = ('../' . _THEME_DIR_ . 'admin/' . 'edit-delete-articles.tpl');
    $controller = new BackEndController();
    $controller->run($index, $js_array, $article);
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";  
}
