<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 18.05.2017
 * Time: 8:52
 */
require_once "../../include/autoload.php";

if(!$session->is_logged_in()) {
    redirect(ADMIN_URL . 'login');
    exit("Please Login!");
} elseif(!User::has_access()) {
    redirect(ADMIN_URL);
    exit("No ACCESS. Contact Administrator");
}

$page = getPage(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING));

get_template('head'); ?>

<div class="container" style="margin-top: 75px;">
    <div class="row">
        <div class="col-sm-8">
            <h1><?php echo t('admin_header'); ?></h1>
        </div>
        <div class="col-sm-4">
            <div class="dropdown text-right">
                <a class="btn btn-secondary dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">
                        <?php echo $session->username; ?>
                        <br><em class="text-muted"><?php echo $groups[$session->group]; ?></em>
                    </a>
                    <a class="dropdown-item" href="<?php echo ADMIN_URL; ?>logout.php">
                        <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if(!empty($session->message)) : ?>
        <div class="row">
            <div class="col-lg-12"><?php echo $session->message; ?></div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-4">
            <?php require_once ADMIN_PATH . 'menu.php'; ?>
        </div>
        <div class="col-sm-8">
            <?php require_once $page['path']; ?>
        </div>
    </div>
</div>

<?php get_template('footer');