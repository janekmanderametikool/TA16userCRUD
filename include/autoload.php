<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 10.05.2016
 * Time: 9:02
 */
//If page is LIVE
//error_reporting(0);

defined('DS') ? NULL : define('DS', DIRECTORY_SEPARATOR);
defined('PX') ? NULL : define('PX', 'kjass_');

//DIRECTORY_SEPARATOR
//Windows \
//Linux /

//CONSTANTS FOR PROJECT

/*
 * CHANGE TWO LINES 20 AND 21-22
 * */
defined('ROOT_URL') ? null : define('ROOT_URL', 'http://ubuntu.ametikool.ee/~janek/TA16/programmeerimine/user-crud/');
defined('ROOT_PATH') ? null :
    define('ROOT_PATH', DS . 'home' . DS . 'janek' . DS . 'public_html' . DS . 'TA16' . DS . 'programmeerimine' . DS . 'user-crud' . DS);

//MAIN CONSTANTS
defined('INCLUDE_PATH') ? null : define('INCLUDE_PATH', ROOT_PATH . 'include' . DS);
defined('MAIN_URL') ? null : define('MAIN_URL', ROOT_URL . 'public/');
defined('MAIN_PATH') ? null : define('MAIN_PATH', ROOT_PATH . 'public' . DS);

defined('ADMIN_URL') ? null : define('ADMIN_URL', MAIN_URL . 'admin/');
defined('ADMIN_PATH') ? null : define('ADMIN_PATH', MAIN_PATH . 'admin' . DS);

//TEMPLATE CONSTANTS
defined('TEMPLATE_PATH') ? null : define('TEMPLATE_PATH', MAIN_PATH . 'template' . DS);
defined('TEMPLATE_URL') ? null : define('TEMPLATE_URL', MAIN_URL . 'template/');
defined('TEMPLATE_URL_CSS') ? null : define('TEMPLATE_URL_CSS', MAIN_URL . 'template/css/');
defined('TEMPLATE_URL_JS') ? null : define('TEMPLATE_URL_JS', MAIN_URL . 'template/js/');
defined('TEMPLATE_URL_PLUGINS') ? null : define('TEMPLATE_URL_PLUGINS', MAIN_URL . 'template/plugins/');

//Static Settings
require_once INCLUDE_PATH . 'settings.php';

//Pages
require_once INCLUDE_PATH . 'pages.php';

//Dynamic classes
require_once INCLUDE_PATH . 'class.MySQLDatabase.php';
require_once INCLUDE_PATH . 'class.DatabaseQuery.php';
require_once INCLUDE_PATH . 'class.Session.php';
require_once INCLUDE_PATH . 'functions.php';

require_once INCLUDE_PATH . 'class.User.php';
require_once INCLUDE_PATH . 'class.Category.php';
require_once INCLUDE_PATH . 'class.Car.php';
require_once INCLUDE_PATH . 'class.Rel.php';