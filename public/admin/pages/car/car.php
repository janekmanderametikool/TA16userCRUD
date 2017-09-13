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

$btn = filter_input(INPUT_POST, 'btn', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$parent = filter_input(INPUT_POST, 'parent', FILTER_VALIDATE_INT);

$ID = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_INT);

if(empty($ID)) {
    $car = new Category();
} else {
    $car = Category::find_by_ID($ID);
}

if(isset($btn)) {
    $errors = [];
    if(empty($name)){
        $errors['name'] = 'Category name cannot be empty';
    } elseif (strlen($name) > 100) {
        $errors['name'] = 'Category name cannot be over 100 characters';
    }

    if(empty($parent)) {
        $parent = 0;
    }

    if(empty($errors)) {

        if (empty($ID)) {
            $car->added_by = $session->user_id;
            $car->added = date("Y-m-d H:i:s");
        }

        $car->name = $name;
        $car->parent = $parent;
        $car->status = 1;
        $car->edited_by = $session->user_id;
        $car->urlSlug($name);

        if($car->save()) {
            if(empty($ID)) {
                $session->message(alert('Category added', 'success'));
                redirect(ADMIN_URL . 'category');
            } else {
                $session->message(alert('Category modified', 'success'));
                redirect(ADMIN_URL . 'category/' . $ID);
            }
        }
    }
}

echo empty($errors) ? '' : "<ul><li>".join("</li><li>", $errors)."</li></ul>";

?>
<form method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control"
            id="name" aria-describedby="name" placeholder="Enter name"
            value="<?php echo isset($car->name) ? $car->name : ''; ?>"
        >
    </div>
    <div class="form-group">
        <?php echo form_select('Parent', 'parent', Category::findCategories($ID), $car->parent); ?>
    </div>

    <button name="btn" value="add" type="submit" class="btn btn-primary">Submit</button>
</form>