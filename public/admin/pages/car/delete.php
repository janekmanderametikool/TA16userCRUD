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
$category = Category::find_by_ID($ID);

if(isset($btn) && $btn == 'delete') {

    if(!Category::findCategoriesByParent($category->ID)) {
        if($category->delete()) {
            $alert = alert("Category {$category->name} deleted!", 'success');
            $session->message($alert);
            redirect(ADMIN_URL . 'category-list');
        }
    }

    $alert = alert("Category {$category->name} was not deleted! It is in use", 'warning');
    $session->message($alert);
    redirect(ADMIN_URL . 'category-list');
}

?>

<div class="card">
    <div class="card-block">
        <h4 class="card-title"><?php echo $category->name; ?></h4>
        <p class="card-text">Are you sure this is correct category?</p>
        <form method="post">
            <button class="btn btn-danger" type="submit" name="btn" value="delete">Confirm delete?</button>
            <a href="<?php echo ADMIN_URL ?>category-list" class="btn btn-primary">Cancel?</a>
        </form>
    </div>
</div>