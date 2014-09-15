<?php
session_start();
session_destroy();
setcookie('neuro_cms_admin', '', time() - 1*24*60*60);
header("location: login.php");
