<?php

require_once(_NEURO_SMARTY_DIR_.'Smarty.class.php');

global $smarty;

$smarty = new Smarty();

$smarty->template_dir = _THEME_DIR_;
$smarty->compile_dir = _NEURO_SMARTY_DIR_.'compile';
$smarty->cache_dir = _THEME_DIR_.'cache';
$smarty->config_dir = _NEURO_SMARTY_DIR_.'configs';
$smarty->caching = false;
$smarty->force_compile = true;
$smarty->compile_check = false;
$smarty->debugging = false; 
$smarty->debugging_ctrl = 'URL';
