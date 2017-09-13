<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 22.05.2017
 * Time: 11:04
 */
require_once "../../include/autoload.php";

if($session->is_logged_in()) {
    $session->logout();
}

redirect(ADMIN_URL);