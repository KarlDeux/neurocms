<?php 

include_once('config/autoload.php');

$article_id = filter_input(INPUT_GET, "article_id", FILTER_SANITIZE_NUMBER_INT);

$tools = new Tools();
$sql = new Sql();

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

$article = array();

$previous_article = $sql->get_previous_article($article_id);
$next_article = $sql->get_next_article($article_id);

$smarty->assign(array(
    'next_article' => $next_article,
    'previous_article' => $previous_article
));

$row = $sql->get_article_data($article_id);
$article['id'] = $row['number'];
$article['type'] = $row['type'];
$article['title'] = $row['title'];
$article['description'] = $row['description'];
$article['images'] = $sql->get_article_img($article_id);
$article['video'] = $row['video'];


$smarty->assign(array(
    'meta_title' => $article['title'],
    'meta_description' => $article['description']
    ));

if (_FRIENDLY_URL_ == 'true') {
    $tools->canonicalRedirection($article['id'] . '-' . $tools->sanitize_url($article['title']) . '.html');
}

try {
    $controller = new FrontEndController();
    $controller->run(_THEME_DIR_ . 'article.tpl', $js_array, $article);
    $_SESSION['ready'] = 0;
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";  
}
