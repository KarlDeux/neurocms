<?php 

include_once('../controller/BackEndController.php');
include_once('../objects/Admin.php');
$admin = new Admin();
$admin->_authenticate();

try {
    $index = ('../' . _THEME_DIR_ . 'admin/' . 'help.tpl');
    $controller = new BackEndController();
    $controller->run($index, $js_array);
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";  
}

?> 