<?php 

include_once('config/base.config.php');
include_once('config/definitions.config.php');
include_once('config/smarty.config.php');
include_once('controller/FrontEndController.php');
include_once('objects/MySqlDatabase.php');

$las_tarticle = filter_input(INPUT_GET, "last_article", FILTER_SANITIZE_NUMBER_INT);

$db = new MySqlDatabase();
$db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

Database::$instance = $db;    

$query = "select 
    a.id,
    a.article_type,
    b.article_name,
    ifnull(d.file_name, '') as file_name
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
where a.id < $las_tarticle order by a.id desc limit 10";

$result = $db->executeQuery($query);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo '<li class="li-loader" id="'.$row['id'].'">
            <a href="article.php?article_id='.$row['id'].'">
                <figure>
                    <img src="admin/uploader/server/php/files/'.$row['id'].'/thumbnail/'.$row['file_name'].'" alt="'.$row['article_name'].'"/>
                    <figcaption><h3>'.$row['article_name'].'</h3></figcaption>
                </figure>
            </a>
        </li>';
}