<?php 

include_once('config/base.config.php');
include_once('config/definitions.config.php');
include_once('config/smarty.config.php');
include_once('controller/FrontEndController.php');
include_once('objects/MySqlDatabase.php');

global $smarty;

$js_array = array();
array_push($js_array, 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
array_push($js_array, _THEME_JS_DIR_ . 'modernizr.custom.js');
array_push($js_array, _THEME_JS_DIR_ . 'jquery.nicescroll.js');
array_push($js_array, _THEME_JS_DIR_ . 'imagesloaded.pkgd.min.js');
array_push($js_array, _THEME_JS_DIR_ . 'masonry.pkgd.min.js');
array_push($js_array, _THEME_JS_DIR_ . 'classie.js');
array_push($js_array, _THEME_JS_DIR_ . 'cbpGridGallery.js');
array_push($js_array, _THEME_JS_DIR_ . 'index.js');

$js1 = 'var cbpAnimatedHeader=(function(){var h=document.documentElement,j=document.querySelector(".cbp-af-header"),l=false,i=300;function k(){window.addEventListener("scroll",function(a){if(!l){l=true;setTimeout(m,250)}},false)}function m(){var a=n();if(a>=i){classie.add(j,"cbp-af-header-shrink")}else{classie.remove(j,"cbp-af-header-shrink")}l=false}function n(){return window.pageYOffset||h.scrollTop}k()})();(function(f){function b(i){return new RegExp("(^|\\s+)"+i+"(\\s+|$)")}function c(k,i){var j=h(k,i)?a:d;j(k,i)}var h,d,a;if("classList" in document.documentElement){h=function(j,i){return j.classList.contains(i)};d=function(j,i){j.classList.add(i)};a=function(j,i){j.classList.remove(i)}}else{h=function(i,j){return b(j).test(i.className)};d=function(j,i){if(!h(j,i)){j.className=j.className+" "+i}};a=function(i,j){i.className=i.className.replace(b(j)," ")}}var g={hasClass:h,addClass:d,removeClass:a,toggleClass:c,has:h,add:d,remove:a,toggle:c};if(typeof define==="function"&&define.amd){define(g)}else{f.classie=g}})(window);';
$js2 = 'new CBPGridGallery( document.getElementById("grid-gallery")); 
        $(document).ready(function() {
            $("body").niceScroll({touchbehavior: false, cursorcolor: "#34495e", cursoropacitymax: 0.9, cursorwidth: 12});
        });';

$js_raw = array($js1, $js2);

$smarty->assign('js_raw', $js_raw);

$smarty->assign(array(
    'meta_title' => __SITE_TITLE__,
    'meta_description' => __SITE_DESCRIPTION__
    ));

$db = new MySqlDatabase();
$db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

Database::$instance = $db;    

$i = 0;
$article = array();

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

$result = $db->executeQuery($query);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $article[$i] = array();
    $article[$i]['id'] = $row['id'];
    $article[$i]['article_type'] = $row['article_type'];
    $article[$i]['article_name'] = $row['article_name'];
    $article[$i]['file_name'] = $row['file_name'];
    $i++;
}

try {
    $controller = new FrontEndController();
    $controller->run($index, $js_array, $article);
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";  
}

?> 