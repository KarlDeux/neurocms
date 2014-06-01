<?php

class Tools {

    function create_guid() {

        $microTime = microtime();
        list($a_dec, $a_sec) = explode(" ", $microTime);

        $dec_hex = dechex($a_dec * 1000000);
        $sec_hex = dechex($a_sec);

        $this->ensure_length($dec_hex, 5);
        $this->ensure_length($sec_hex, 6);

        $guid = "";
        $guid .= $dec_hex;
        $guid .= $this->create_guid_section(3);
        $guid .= '-';
        $guid .= $this->create_guid_section(4);
        $guid .= '-';
        $guid .= $this->create_guid_section(4);
        $guid .= '-';
        $guid .= $this->create_guid_section(4);
        $guid .= '-';
        $guid .= $sec_hex;
        $guid .= $this->create_guid_section(6);

        return $guid;
    }

    function create_guid_section($characters) {

        $return = "";

        for ($i = 0; $i < $characters; $i++) {

            $return .= dechex(mt_rand(0, 15));
        }

        return $return;
    }

    function ensure_length(&$string, $length) {

        $strlen = strlen($string);

        if ($strlen < $length) {

            $string = str_pad($string, $length, "0");
        } else if ($strlen > $length) {

            $string = substr($string, 0, $length);
        }
    }

    function microtime_diff($a, $b) {

        list($a_dec, $a_sec) = explode(" ", $a);
        list($b_dec, $b_sec) = explode(" ", $b);
        return $b_sec - $a_sec + $b_dec - $a_dec;
    }

    function new_article_id() {
        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

        Database::$instance = $db;

        $result = $db->executeQuery("select id from " . _DB_PREFIX_ . "article order by id desc limit 1");

        $row = $result->fetch_row();

        return !$row[0] ? 1 : ($row[0] + 1);
    }

    function get_next_article($current) {
        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

        Database::$instance = $db;

        $result = $db->executeQuery("select id from " . _DB_PREFIX_ . "article where id > $current order by id limit 1");

        $row = $result->fetch_row();

        return !$row[0] ? false : $row[0];
    }

    function get_previous_article($current) {
        $db = new MySqlDatabase();
        $db->connect(_DB_SERVER_, _DB_NAME_, _DB_USER_, _DB_PASSWD_);

        Database::$instance = $db;

        $result = $db->executeQuery("select id from " . _DB_PREFIX_ . "article where id < $current order by id desc limit 1");

        $row = $result->fetch_row();

        return !$row[0] ? false : $row[0];
    }

    function sanitize_url($string) {

        $string = trim($string);

        $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string
        );

        $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string
        );

        $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string
        );

        $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string
        );

        $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string
        );

        $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C'), $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
                array("\\", "¨", "º", "~",
            "#", "@", "|", "!", "\"",
            "·", "$", "%", "&", "/",
            "(", ")", "?", "'", "¡",
            "¿", "[", "^", "`", "]",
            "+", "}", "{", "¨", "´",
            ">", "< ", ";", ",", ":",
            "."), '', $string
        );

        $string = str_replace(
                array(' '), array('-'), $string
        );


        return $string;
    }

    public function canonicalRedirection($link) {
        session_name("friendly_url");
	session_start();
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && $_SESSION['ready'] != 1) {
            $canonicalURL = $link;
            if (!preg_match('/^' . $this->pRegexp(__BASE_URI__.  $canonicalURL, '/') . '([&?].*)?$/', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])) {
                header('HTTP/1.0 301 Moved');
                $_SESSION['ready'] = 1;
                $this->redirectLink($canonicalURL);
            }
        }
    }

    public static function redirectLink($url) {
        if (!preg_match('@^https?://@i', $url)) {
            if (strpos($url, __BASE_URI__) !== FALSE && strpos($url, __BASE_URI__) == 0) {
                $url = substr($url, strlen(__BASE_URI__));
            }
        }

        header('Location: ' . $url);
        exit;
    }

    public static function pRegexp($s, $delim) {
        $s = str_replace($delim, '\\' . $delim, $s);
        foreach (array('?', '[', ']', '(', ')', '{', '}', '-', '.', '+', '*', '^', '$') as $char) {
            $s = str_replace($char, '\\' . $char, $s);
        }
        return $s;
    }

}