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

pd($_GET);

$btn = filter_input(INPUT_POST, 'btn', FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$password_again = filter_input(INPUT_POST, 'password_again', FILTER_SANITIZE_STRING);
$group_rights = filter_input(INPUT_POST, 'group_rights', FILTER_VALIDATE_INT);

$ID = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_INT);

if(empty($ID)) {
    $user = new User();
} else {
    $user = User::find_by_ID($ID);
}

if(isset($btn)) {
    $errors = [];
    if(empty($username)){
        $errors['username'] = 'Username cannot be empty';
    } elseif (strlen($username) > 100) {
        $errors['username'] = 'Username cannot be over 100 characters';
    }

    if(empty($ID)) {
        if(empty($password)){
            $errors['password'] = 'Password cannot be empty';
        } elseif ($password != $password_again) {
            $errors['password'] = 'Passwords did not match';
        }
    }

    if(empty($group_rights)) {
        $group_rights = 0;
    }

    if(empty($errors)) {

        if(empty($ID)) {
            $user->last_login = '0000-00-00 00:00:00';
            $user->added_by = $session->user_id;
            $user->added = date("Y-m-d H:i:s");
            $user->password = better_crypt($password);
        } else {
            $user->password = empty($password) ? $user->password : better_crypt($password);
        }

        $user->username = $username;
        $user->group_rights = $group_rights;
        $user->status = 1;
        $user->edited_by = $session->user_id;

        if($user->save()) {
            if(empty($ID)) {
                $session->message(alert('User added', 'success'));
                redirect(ADMIN_URL . 'user');
            } else {
                $session->message(alert('User modified', 'success'));
                redirect(ADMIN_URL . 'user/' . $ID);
            }

        }
    }
}

echo empty($errors) ? '' : "<ul><li>".join("</li><li>", $errors)."</li></ul>";

?>
<form method="post">
    <div class="form-group">
        <label for="username">Email</label>
        <input name="username" type="email" class="form-control"
            id="username" aria-describedby="username" placeholder="Enter email"
            value="<?php echo isset($user->username) ? $user->username : ''; ?>"
        >
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
    </div>
    <?php if (empty($ID)) : ?>
    <div class="form-group">
        <label for="password_again">Password Again</label>
        <input name="password_again" type="password" class="form-control" id="password_again" placeholder="Reenter Password">
    </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="group_rights">User Group</label>
        <select name="group_rights" class="form-control" id="group_rights">
            <option value="0" <?php echo isset($user->group_rights) && $user->group_rights == 0 ? 'selected' : '' ?>>0</option>
            <option value="1" <?php echo isset($user->group_rights) && $user->group_rights == 1 ? 'selected' : '' ?>>1</option>
            <option value="2" <?php echo isset($user->group_rights) && $user->group_rights == 2 ? 'selected' : '' ?>>2</option>
            <option value="99" <?php echo isset($user->group_rights) && $user->group_rights == 99 ? 'selected' : '' ?>>99</option>
        </select>
    </div>

    <button name="btn" value="add" type="submit" class="btn btn-primary">Submit</button>
</form>