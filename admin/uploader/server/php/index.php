<?php

/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);
$folder = filter_input(INPUT_GET, "folder", FILTER_SANITIZE_STRING);
require('UploadHandler.php');
if ($folder != '') {
    $options = array('folder' => $folder);
    $upload_handler = new UploadHandler($options, true);
} else {
    $upload_handler = new UploadHandler();
}