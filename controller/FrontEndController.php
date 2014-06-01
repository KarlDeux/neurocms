<?php

include_once('config/base.config.php');
include_once('config/definitions.config.php');
include_once('config/smarty.config.php');
include_once('objects/Tools.php');
include_once('objects/CSSmin.php');
include_once('objects/Exception.php');
include_once('objects/MySqlDatabase.php');
include_once('Controller.php');

class FrontEndController extends Controller {

    public function initialize() {
        parent::initializeDatabase();
        global $smarty;

        $compressor = new CSSmin();

        $iCSS1 = str_replace(array('../../', '../fonts/'), array(_THEME_DIR_, _THEME_FONTS_DIR_), file_get_contents(_THEME_CSS_DIR_ . 'global.css', true));
        $oCSS1 = $compressor->run($iCSS1);

        $smarty->assign(array(
            'meta_keywords' => 'key, words',
            'page_name' => 'page_name',
            'img_theme_dir' => _THEME_IMG_DIR_,
            'js_theme_dir' => _THEME_JS_DIR_,
            'fonts_theme_dir' => _THEME_FONTS_DIR_,
            'base_uri' => __BASE_URI__,
            'css' => $oCSS1
        ));
    }

    public function showHeader() {
        global $smarty;

        $smarty->display(_THEME_DIR_ . 'header.tpl');
    }

    public function showIndex($index, $data) {
        global $smarty;

        if ($data) {
            $smarty->assign('data', $data);
        }

        if (!$index) {
            $smarty->display(_THEME_DIR_ . 'index.tpl');
        } else {
            $smarty->display($index);
        }
    }

    public function showFooter($js_array) {
        global $smarty;

        $smarty->assign('js_array', $js_array);
        $smarty->display(_THEME_DIR_ . 'footer.tpl');
    }

}
