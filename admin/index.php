<?php 

include_once('../controller/BackEndController.php');
include_once('../objects/Admin.php');
$admin = new Admin();
$admin->_authenticate();

try {
    $controller = new BackEndController();
    $controller->run($index, $js_array);
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";  
}
