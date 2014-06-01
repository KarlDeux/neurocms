<?php

class Sql {

    function new_article_id() {
        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

        Database::$instance = $db;

        $result = $db->executeQuery("select id from " . _DB_PREFIX_ . "article order by id desc limit 1");

        $row = $result->fetch_row();

        return !$row[0] ? 1 : ($row[0] + 1);
    }

    function get_next_article($current) {
        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

        Database::$instance = $db;

        $result = $db->executeQuery("select id from " . _DB_PREFIX_ . "article where id > $current order by id limit 1");

        $row = $result->fetch_row();

        return !$row[0] ? false : $row[0];
    }

    function get_previous_article($current) {
        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

        Database::$instance = $db;

        $result = $db->executeQuery("select id from " . _DB_PREFIX_ . "article where id < $current order by id desc limit 1");

        $row = $result->fetch_row();

        return !$row[0] ? false : $row[0];
    }

    function get_article_data($article_id) {
        $query = "select 
	a.id as number,
	a.article_type as type,
	b.article_name as title,
	b.article_description as description,
	c.video_id as video
from
	" . _DB_PREFIX_ . "article as a
		inner join
        " . _DB_PREFIX_ . "article_lang as b ON a.id = b.article_id
		left join
	" . _DB_PREFIX_ . "video as c ON a.id = c.article_id
where 
	a.id = $article_id";

        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

        Database::$instance = $db;

        $result = $db->executeQuery($query);

        $row = $result->fetch_assoc();

        return $row;
    }

    function get_article_img($article_id) {

        $images = array();

        $query = "select 
	concat(folder, '/', file_name) as files 
from 
    " . _DB_PREFIX_ . "uploaded_files
where 
	folder = $article_id";

        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

        Database::$instance = $db;

        $result = $db->executeQuery($query);

        while ($rowimg = mysqli_fetch_array($result)) {
            array_push($images, $rowimg['files']);
        }

        return $images;
    }

    function get_index_data() {
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
order by id desc limit 25";

        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

        Database::$instance = $db;

        return $db->executeQuery($query);
    }

}