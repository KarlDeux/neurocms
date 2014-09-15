<?php
/*
CREATE TABLE IF NOT EXISTS `neuro_admin` (
    `id` int(15) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL DEFAULT '',
    `nicename` varchar(255) NOT NULL DEFAULT '',
    `email` varchar(255) NOT NULL DEFAULT '',
    `password` varchar(255) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE KEY `nicename` (`nicename`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

INSERT INTO `neuro_admin` (`username`, `nicename`, `email`, `password`)
VALUES (
'admin_name', 'Full name', 'email', SHA1('password')
);

CREATE TABLE IF NOT EXISTS `neuro_article` (
    `id` int(15) NOT NULL,
    `article_type` varchar(10) DEFAULT NULL,
    `publisher` varchar(25) DEFAULT NULL,
    `article_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id` (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `neuro_article_lang` (
    `id` int(15) NOT NULL AUTO_INCREMENT,
    `id_lang` int(15) DEFAULT NULL,
    `article_id` int(15) DEFAULT NULL,
    `article_name` tinytext,
    `article_description` mediumtext,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id` (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=52;


CREATE TABLE IF NOT EXISTS `neuro_category` (
    `id` int(15) NOT NULL AUTO_INCREMENT,
    `parent` int(15) DEFAULT NULL,
    `category_order` int(15) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id` (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

INSERT INTO `neuro_category` (`id`, `parent`, `category_order`) VALUES
(1, 0, 0);

CREATE TABLE IF NOT EXISTS `neuro_category_lang` (
    `id` int(15) NOT NULL AUTO_INCREMENT,
    `id_lang` int(15) DEFAULT NULL,
    `category_id` int(15) DEFAULT NULL,
    `category_name` varchar(25) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id` (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

INSERT INTO `neuro_category_lang` (`id`, `id_lang`, `category_id`, `category_name`) VALUES
(1, 1, 1, 'home');

CREATE TABLE IF NOT EXISTS `neuro_config` (
    `id` int(15) NOT NULL AUTO_INCREMENT,
    `property` varchar(50) NOT NULL DEFAULT '',
    `value` varchar(50) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=17;

INSERT INTO `neuro_config` (`id`, `property`, `value`) VALUES
(1, '__BASE_URI__', 'http:/site-with-full-path/'),
(2, '_THEME_NAME_', 'basic'),
(3, '__NEURO_BASE_URI__', ''),
(4, '__NEURO_ADMIN_URI__', '/admin/'),
(5, '__SITE_TITLE__', 'Site title'),
(6, '_IMG_UPLOADS_', '/uploads/img/'),
(7, '_ADMIN_NAME_', 'admin'),
(8, '_THEME_NAME_', 'basic'),
(9, '_DB_NAME_', 'neurocms'),
(10, '_MYSQL_ENGINE_', 'InnoDB'),
(11, '_DB_SERVER_', 'localhost'),
(12, '_DB_USER_', 'db_user'),
(13, '_DB_PREFIX_', 'neuro_'),
(14, '_DB_PASSWD_', 'db_password'),
(15, '_DB_TYPE_', 'MySQL'),
(16, '_UID_', 'c8bc3d0e-e6b5-afac-6693-536fa323c25b');

CREATE TABLE IF NOT EXISTS `neuro_lang` (
    `id` int(15) NOT NULL AUTO_INCREMENT,
    `lang` varchar(15) DEFAULT NULL,
    `lang_shortcut` varchar(3) DEFAULT NULL,
    `lang_predefined` int(1) DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `id` (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

INSERT INTO `neuro_lang` (`id`, `lang`, `lang_shortcut`, `lang_predefined`) VALUES
(1, 'English', 'EN', 1);

CREATE TABLE IF NOT EXISTS `neuro_uploaded_files` (
    `id` int(15) NOT NULL AUTO_INCREMENT,
    `folder` int(15) DEFAULT NULL,
    `thumbnail` tinyint(1) DEFAULT NULL,
    `file_name` text,
    PRIMARY KEY (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=267;

CREATE TABLE IF NOT EXISTS `neuro_video` (
    `id` int(15) NOT NULL AUTO_INCREMENT,
    `article_id` int(15) DEFAULT NULL,
    `video_id` varchar(15) DEFAULT NULL,
    PRIMARY KEY (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;
*/
