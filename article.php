<?php 

include_once('config/base.config.php');
include_once('config/definitions.config.php');
include_once('config/smarty.config.php');
include_once('controller/FrontEndController.php');
include_once('objects/MySqlDatabase.php');
include_once('objects/Tools.php');

$article_id = filter_input(INPUT_GET, "article_id", FILTER_SANITIZE_NUMBER_INT);

$tools = new Tools();

global $smarty;

$js_array = array();
array_push($js_array, 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
array_push($js_array, _THEME_JS_DIR_ . 'modernizr.custom.js');
array_push($js_array, _THEME_JS_DIR_ . 'jquery.nicescroll.js');


$js1 = 'var cbpAnimatedHeader=(function(){var h=document.documentElement,j=document.querySelector(".cbp-af-header"),l=false,i=300;function k(){window.addEventListener("scroll",function(a){if(!l){l=true;setTimeout(m,250)}},false)}function m(){var a=n();if(a>=i){classie.add(j,"cbp-af-header-shrink")}else{classie.remove(j,"cbp-af-header-shrink")}l=false}function n(){return window.pageYOffset||h.scrollTop}k()})();(function(f){function b(i){return new RegExp("(^|\\s+)"+i+"(\\s+|$)")}function c(k,i){var j=h(k,i)?a:d;j(k,i)}var h,d,a;if("classList" in document.documentElement){h=function(j,i){return j.classList.contains(i)};d=function(j,i){j.classList.add(i)};a=function(j,i){j.classList.remove(i)}}else{h=function(i,j){return b(j).test(i.className)};d=function(j,i){if(!h(j,i)){j.className=j.className+" "+i}};a=function(i,j){i.className=i.className.replace(b(j)," ")}}var g={hasClass:h,addClass:d,removeClass:a,toggleClass:c,has:h,add:d,remove:a,toggle:c};if(typeof define==="function"&&define.amd){define(g)}else{f.classie=g}})(window);';
$js2 = '$(document).ready(function() {
            $("body").niceScroll({touchbehavior: false, cursorcolor: "#34495e", cursoropacitymax: 0.9, cursorwidth: 12});
        });';

$js_raw = array($js1, $js2);

$smarty->assign('js_raw', $js_raw);

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

$next_article = $tools->get_next_article($article_id);
$previous_article = $tools->get_previous_article($article_id);

$smarty->assign(array(
    'next_article' => $next_article,
    'previous_article' => $previous_article
));

while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    $article[$i] = array();
    $article[$i]['id'] = $row['number'];
    $article[$i]['type'] = $row['type'];
    $article[$i]['title'] = $row['title'];
    $article[$i]['description'] = $row['description'];
    while($rowimg = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        array_push($images, $rowimg['files']);
    }
    $article[$i]['images'] = $images;
    $article[$i]['video'] = $row['video'];
    $i++;
}

$smarty->assign(array(
    'meta_title' => $article[0]['title'],
    'meta_description' => $article[0]['description']
    ));

if (_FRIENDLY_URL_ == 'true') {
    $tools->canonicalRedirection($article[0]['id'] . '-' . $tools->sanitize_url($article[0]['title']) . '.html');
}

try {
    $controller = new FrontEndController();
    $controller->run(_THEME_DIR_ . 'article.tpl', $js_array, $article);
    $_SESSION['ready'] = 0;
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";  
}

?> 