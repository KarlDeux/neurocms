<?php /* Smarty version Smarty-3.1.15, created on 2014-05-05 13:32:11
         compiled from "I:\xampp\htdocs\proyecto\themes\basic\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24983536776bb43f913-72317198%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac8f6889655b73627f3ee6278d1bb861b640dd18' => 
    array (
      0 => 'I:\\xampp\\htdocs\\proyecto\\themes\\basic\\footer.tpl',
      1 => 1399289436,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24983536776bb43f913-72317198',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'js_theme_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_536776bb443795_11650035',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_536776bb443795_11650035')) {function content_536776bb443795_11650035($_smarty_tpl) {?></body><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['js_theme_dir']->value;?>
jquery.nicescroll.js"></script><script>var cbpAnimatedHeader=(function(){var h=document.documentElement,j=document.querySelector(".cbp-af-header"),l=false,i=300;function k(){window.addEventListener("scroll",function(a){if(!l){l=true;setTimeout(m,250)}},false)}function m(){var a=n();if(a>=i){classie.add(j,"cbp-af-header-shrink")}else{classie.remove(j,"cbp-af-header-shrink")}l=false}function n(){return window.pageYOffset||h.scrollTop}k()})();(function(f){function b(i){return new RegExp("(^|\\s+)"+i+"(\\s+|$)")}function c(k,i){var j=h(k,i)?a:d;j(k,i)}var h,d,a;if("classList" in document.documentElement){h=function(j,i){return j.classList.contains(i)};d=function(j,i){j.classList.add(i)};a=function(j,i){j.classList.remove(i)}}else{h=function(i,j){return b(j).test(i.className)};d=function(j,i){if(!h(j,i)){j.className=j.className+" "+i}};a=function(i,j){i.className=i.className.replace(b(j)," ")}}var g={hasClass:h,addClass:d,removeClass:a,toggleClass:c,has:h,add:d,remove:a,toggle:c};if(typeof define==="function"&&define.amd){define(g)}else{f.classie=g}})(window);</script>
    <script>
        $(document).ready(function() {
            var nicesx = $("body").niceScroll({touchbehavior: false, cursorcolor: "black", cursoropacitymax: 0.9, cursorwidth: 12});
        });
    </script>
</html><?php }} ?>
