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
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$info = filter_input(INPUT_POST, 'info', FILTER_SANITIZE_STRING);

$args = [
    'categories' => [
        'filter' => FILTER_VALIDATE_INT,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
];
$categories = filter_input_array(INPUT_POST, $args);

$ID = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_INT);

if(empty($ID)) {
    $car = new Car();
} else {
    $car = Car::find_by_ID($ID);
}

$translations = Translate::getTranslations($ID, 'Car', getLanguage());

if(isset($btn)) {
    $errors = [];
    if(empty($name)){
        $errors['name'] = 'Car name cannot be empty';
    } elseif (strlen($name) > 100) {
        $errors['name'] = 'Car name cannot be over 100 characters';
    }

    if(empty($price)){
        $errors['price'] = 'Price cannot be empty';
    }

    if(empty($errors)) {

        if (empty($ID)) {
            $car->added_by = $session->user_id;
            $car->added = date("Y-m-d H:i:s");
        }

        $car->name = $name;
        $car->price = $price;
        if (getLanguage() == 'en') {
            $car->info = $info;
        }

        $car->status = 1;
        $car->edited_by = $session->user_id;
        $car->urlSlug($name);

        if($car->save()) {

            $car_id = empty($ID) ? $database->get_last_id() : $ID;

            if (getLanguage() != 'en') {
                $translation = Translate::getTranslation($car_id, 'Car', 'info', getLanguage());
                if (empty($translation)) {
                    $translation = new Translate();
                    $translation->table_id = $car_id;
                    $translation->class = 'Car';
                    $translation->keyword = 'info';
                    $translation->language = getLanguage();
                    $translation->added = date("Y-m-d H:i:s");
                }

                $translation->translation = $info;
                $translation->save();
            }

            Rel::deleteByCar($car_id);
            if (!empty($categories['categories']) && !empty($car_id)) : foreach ($categories['categories'] as $category_id) {
                $nRel = new Rel();
                $nRel->car_id = $car_id;
                $nRel->category_id = $category_id;
                $nRel->added = date("Y-m-d H:i:s");

                if (!empty($category_id)) {
                    $nRel->save();
                }

            } endif;

            if(empty($ID)) {
                $session->message(alert('Car added', 'success'));
                redirect(ADMIN_URL . 'car');
            } else {
                $session->message(alert('Car modified', 'success'));
                redirect(ADMIN_URL . 'car/' . $ID);
            }
        }
    }
}

echo empty($errors) ? '' : "<ul><li>".join("</li><li>", $errors)."</li></ul>";

?>
<form method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" id="name" aria-describedby="name"
               placeholder="Enter name" value="<?php echo isset($car->name) ? $car->name : ''; ?>"
        >
    </div>
    <div class="form-group">
        <label for="name">Price</label>
        <input name="price" type="text" class="form-control" id="price" aria-describedby="name"
               placeholder="1999" value="<?php echo isset($car->price) ? $car->price : ''; ?>"
        >
    </div>
    <div class="form-group">
        <label for="name"><?php echo t('admin_car_info'); ?><i class="fa fa-language"></i> <span class="change_language" data-language="en"><?php echo t('head_dropdown_english'); ?></span> | <span class="change_language" data-language="et"><?php echo t('head_dropdown_estonia'); ?></span></label>
        <textarea name="info" class="form-control" id="info" aria-describedby="name"
                  placeholder="1999"><?php echo Translate::t($car, 'info', $translations); ?></textarea>
    </div>

    <?php
        $mainCategories = Category::findMainCategories();
        $carCategories = Rel::findByCar($car->ID);
        if (!empty($carCategories)) {
            $carCategories = array_column($carCategories, 'category_id');
        }

        if (!empty($mainCategories)) : foreach ($mainCategories as $cat) { ?>
            <?php
                $subCategories = Category::findCategoriesByParent($cat->ID);

                $s = 0;

                if (!empty($carCategories) && !empty($subCategories)) {
                    $s = array_intersect($carCategories, array_column($subCategories, 'ID'));
                    $s = array_shift($s);
                }

            ?>
            <?php echo form_select($cat->name, 'categories[]', $subCategories, $s); ?>
        <?php } endif;
    ?>
    <br>
    <button name="btn" value="add" type="submit" class="btn btn-primary">Submit</button>
</form>