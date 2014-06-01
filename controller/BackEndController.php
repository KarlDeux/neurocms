<?php

include_once('../config/base.config.php');
include_once('../config/definitions.config.php');
include_once('../config/smarty.config.php');
include_once('../objects/Tools.php');
include_once('../objects/CSSmin.php');
include_once('../objects/Exception.php');
include_once('../objects/MySqlDatabase.php');
include_once('Controller.php');

class BackEndController extends Controller {
    public function initialize() {
        parent::initializeDatabase();
        
        global $smarty;
                
        $compressor = new CSSmin();

        $iCSS1 = file_get_contents(__NEURO_ADMIN_URI__ . 'css/' . 'style.css', true);
        $iCSS2 = file_get_contents(__NEURO_ADMIN_URI__ . 'css/' . 'font-awesome.css', true);
        $iCSS3 = file_get_contents(__NEURO_ADMIN_URI__ . 'uploader/css/jquery-ui.css', true);
        $iCSS4 = file_get_contents(__NEURO_ADMIN_URI__ . 'uploader/css/jquery.fileupload.css', true);
        $iCSS5 = file_get_contents(__NEURO_ADMIN_URI__ . 'uploader/css/blueimp-gallery.min.css', true);
        $oCSS1 = $compressor->run($iCSS1);
        $oCSS2 = $compressor->run($iCSS2);
        $oCSS3 = $compressor->run($iCSS3);
        $oCSS4 = $compressor->run($iCSS4);
        $oCSS5 = $compressor->run($iCSS5);
                                        
        $smarty->assign(array(
            'meta_title' => 'title',
            'meta_description' => 'descripcion',
            'meta_keywords' => 'key, words',
            'page_name' => basename($_SERVER['PHP_SELF']),
            'img_theme_dir' => _THEME_IMG_DIR_,
            'js_theme_dir' => _THEME_JS_DIR_,
            'fonts_theme_dir' => _THEME_FONTS_DIR_,
            'css' => $oCSS1 . $oCSS2 . $oCSS3 . $oCSS4 . $oCSS5,
            'site_title' => __SITE_TITLE__,
            'site_uri' => __BASE_URI__,
            'admin_uri' => __BASE_URI__ . _ADMIN_NAME_
        ));
                
    }
        
     public function showHeader() {
        global $smarty;

        $smarty->display('../' . _THEME_DIR_ . 'admin/' . 'header.tpl');
    }

    public function showIndex($index, $data) {
        global $smarty;
        
        if ($data) {
            $smarty->assign('data', $data);
        }
        
        if (!$index) {
            $smarty->display('../' . _THEME_DIR_ . 'admin/' . 'index.tpl');
        } else {
            $smarty->display($index);
        }
    }

    public function showFooter($js_array) {
        global $smarty;
        
        $smarty->assign('js_array', $js_array);
        $smarty->display('../' . _THEME_DIR_ . 'admin/' . 'footer.tpl');
    }
    
}