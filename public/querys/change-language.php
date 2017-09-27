<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 27.09.2017
 * Time: 12:55
 */

require_once "../../include/autoload.php";

$language = filter_input(INPUT_POST, 'language', FILTER_SANITIZE_STRING);

if (in_array($language, $languages)) {
    $_SESSION['language'] = $language;
}