<?php

include_once('../controller/BackEndController.php');
include_once('../objects/Admin.php');
$admin = new Admin();
$admin->_authenticate();

$article_id = filter_input(INPUT_GET, "article", FILTER_SANITIZE_NUMBER_INT);

global $smarty;

if ($article_id) {

    $db = new MySqlDatabase();
    $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

    Database::$instance = $db;

    $i = 0;
    $article = array();
    $images = array();

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

    $query2 = "select 
            concat(folder, '/', file_name) as files 
    from 
        " . _DB_PREFIX_ . "uploaded_files
    where 
            folder = $article_id";

    $result1 = $db->executeQuery($query);
    $result2 = $db->executeQuery($query2);

    while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
        $article[$i] = array();
        $article[$i]['id'] = $row['number'];
        $article[$i]['type'] = $row['type'];
        $article[$i]['title'] = $row['title'];
        $article[$i]['description'] = $row['description'];
        while ($rowimg = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            array_push($images, $rowimg['files']);
        }
        $article[$i]['images'] = $images;
        $article[$i]['video'] = $row['video'];
        $i++;
    }
    
    $smarty->assign(array(
        'article' => $article
    ));
}

try {
    $index = ('../' . _THEME_DIR_ . 'admin/' . 'new-article.tpl');
    $js_array = array();
    array_push($js_array, 'js/new-article.js');
    array_push($js_array, __BASE_URI__ . 'admin/uploader/js/vendor/jquery.ui.widget.js');
    array_push($js_array, 'http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js');
    array_push($js_array, 'http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js');
    array_push($js_array, 'http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js');
    array_push($js_array, 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js');
    array_push($js_array, 'http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js');
    array_push($js_array, __BASE_URI__ . 'admin/uploader/js/jquery.iframe-transport.js');
    array_push($js_array, __BASE_URI__ . 'admin/uploader/js/jquery.fileupload.js');
    array_push($js_array, __BASE_URI__ . 'admin/uploader/js/jquery.fileupload-process.js');
    array_push($js_array, __BASE_URI__ . 'admin/uploader/js/jquery.fileupload-image.js');
    array_push($js_array, __BASE_URI__ . 'admin/uploader/js/jquery.fileupload-validate.js');
    array_push($js_array, __BASE_URI__ . 'admin/uploader/js/jquery.fileupload-ui.js');
    array_push($js_array, __BASE_URI__ . 'admin/uploader/js/main.js');
    $controller = new BackEndController();
    $tools = new Tools();
    $smarty->assign(array(
        'article_id' => !$article_id ? $tools->new_article_id() : $article_id
    ));
    $controller->run($index, $js_array);
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}
