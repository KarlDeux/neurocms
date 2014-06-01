<?php 

include_once('config/base.config.php');
include_once('config/definitions.config.php');
include_once('config/smarty.config.php');
include_once('controller/FrontEndController.php');
include_once('objects/MySqlDatabase.php');

try {
    $controller = new FrontEndController();
    $controller->run(_THEME_DIR_ . '404.tpl');
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";  
}

?> 