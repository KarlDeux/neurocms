<?php

/*
 * NeuroCMS
 * https://github.com/KarlDeux/neurocms
 *
 * Copyright 2014, Carlos Lizaga
 * http://www.neurotix.es
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

define('__BASE_URI__', 'http://www.domain.com/subdomain/');
define('__NEURO_BASE_URI__', getenv("DOCUMENT_ROOT") . "/subdomain/");
define('__NEURO_ADMIN_URI__', getenv("DOCUMENT_ROOT") . "/subdomain/admin/");
define('__SITE_TITLE__', 'Page title');
define('__SITE_DESCRIPTION__', 'Page description');
define('_IMG_UPLOADS_', __NEURO_BASE_URI__ . "/uploads/img/");
define('_ADMIN_NAME_', 'admin');
define('_THEME_NAME_', 'basic');
define('_DB_NAME_', 'neurocms');
define('_MYSQL_ENGINE_', 'InnoDB');
define('_DB_SERVER_', 'localhost');
define('_DB_USER_', '_DB_USER_');
define('_DB_PREFIX_', 'neuro_');
define('_DB_PASSWD_', '_DB_PASSWD_');
define('_DB_TYPE_', 'MySQL');
define('_UID_', 'c8bc3d0e-e6b5-afac-6693-536fa323c25b');
define('_FRIENDLY_URL_', 'true');

?>
