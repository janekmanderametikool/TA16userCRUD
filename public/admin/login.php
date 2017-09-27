<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 18.05.2017
 * Time: 10:00
 */
require_once "../../include/autoload.php";

pd($language);

$btn = filter_input(INPUT_POST, 'btn', FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if(isset($btn)) {
    $errors = [];
    if (empty($username)) {
        $errors['username'] = 'Username cannot be empty';
    } elseif (strlen($username) > 100) {
        $errors['username'] = 'Username cannot be over 100 characters';
    }

    if (empty($password)) {
        $errors['password'] = 'Password cannot be empty';
    }

    if(empty($errors)) {
        //1. kontroll kas username exists

        //2. kontroll paroolile userInput -> dbHash

        //Kui tingimused true, siis logime kasutaja sisse ja suuname admin/index lehele

        if($user = User::auth($username, $password)) {
            $session->login($user);
            redirect(ADMIN_URL);
        }
    }
}

get_template('head'); ?>

    <div class="container">
        <h1><?php echo t('login_header'); ?></h1>

        <form method="POST">
            <div class="form-group">
                <label for="username"><?php echo t('login_email'); ?></label>
                <input name="username" type="email" class="form-control"
                       id="username" aria-describedby="username" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password"><?php echo t('login_password'); ?></label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button name="btn" value="login" type="submit" class="btn btn-primary"><?php echo t('login_button'); ?></button>
        </form>

    </div>

<?php get_template('footer');
