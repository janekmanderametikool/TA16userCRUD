<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 18.05.2017
 * Time: 8:54
 */

if(!defined('ROOT_PATH')) {
    exit("No Direct access");
}

$ID = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_INT);
$btn = filter_input(INPUT_POST, 'btn', FILTER_SANITIZE_STRING);
$user = User::find_by_ID($ID);

if(isset($btn) && $btn == 'delete') {
    if($session->user_id != $ID) {
        if($user->delete()) {
            $alert = alert("User {$user->username} deleted!", 'success');
            $session->message($alert);
            redirect(ADMIN_URL . 'user-list');
        }

        $alert = alert("User {$user->username} was not deleted!", 'warning');
        $session->message($alert);
        redirect(ADMIN_URL . 'user-list');
    }

    $alert = alert('You cannot delete yourself!', 'danger');
    $session->message($alert);

    redirect(ADMIN_URL . 'user-list');
}

?>

<div class="card">
    <img class="card-img-top img-fluid" src="<?php echo TEMPLATE_URL; ?>images/user-no-picture.png" alt="Card image cap">
    <div class="card-block">
        <h4 class="card-title"><?php echo $user->username; ?></h4>
        <p class="card-text">Are you sure this is correct user?</p>
        <form method="post">
            <button class="btn btn-danger" type="submit" name="btn" value="delete">Confirm delete?</button>
            <a href="<?php echo ADMIN_URL ?>user-list" class="btn btn-primary">Cancel?</a>
        </form>
    </div>
</div>