<?php

/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 10.05.2016
 * Time: 9:01
 */
class Session
{
    private $logged_in = false;
    public $user_id;
    public $message;
    public $username;
    public $group;

    function __construct() {
        session_start();
        $this->check_login();
        $this->check_message();

    }

    public function is_logged_in() {
        return $this->logged_in;
    }

    private function check_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->username = $_SESSION['username'];
            $this->group = $_SESSION['group'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }

    private function check_message() {
        if(isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    public function message ($msg = ""){
        if(empty($msg)) {
            return $this->message;
        } else {
            $_SESSION['message'] = $msg;
        }
    }

    public function login($user) {
        if($user) {
            $this->user_id = $_SESSION['user_id'] = $user->ID;
            $this->logged_in = true;
            $this->username = $_SESSION['username'] = $user->username;
            $this->group = $_SESSION['group'] = $user->group_rights;
        }
    }

    public function logout() {
        $tLang = $_SESSION['language'];
        session_unset();
        $_SESSION['language'] = $tLang;
        unset($this->user_id);
        $this->logged_in = false;
    }
}

$session = new Session();
$message = $session->message();