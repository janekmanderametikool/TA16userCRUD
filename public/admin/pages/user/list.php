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


$users = User::find_all(); ?>

<h1 class="text-right">
    <?php echo $page['name'] ?>
    <small>
        <a href="<?php echo ADMIN_URL . 'user'; ?>">
            <i class="fa fa-address-book-o" aria-hidden="true"></i>
        </a>
    </small>
</h1>

<?php if(!empty($users)) { ?>
    <table class="table">
        <tr>
            <th>Username</th>
            <th>Last Login</th>
            <th>Group</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user->username; ?></td>
                <td><?php echo $user->last_login; ?></td>
                <td><?php echo $user->group_rights; ?></td>
                <td>
                    <a href="<?php echo ADMIN_URL . 'user/' . $user->ID; ?>">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </td>
                <td>
                    <a href="<?php echo ADMIN_URL . 'user-delete/' . $user->ID; ?>"
                       class="btn btn-danger <?php echo $session->user_id == $user->ID ? 'disabled' :'' ?>">
                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php }