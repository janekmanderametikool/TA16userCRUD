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


$categories = Category::findCategories();

    //TODO make 3 type categories: select, checkbox, input

?>

<h1 class="text-right">
    <?php echo $page['name'] ?>
    <small>
        <a href="<?php echo ADMIN_URL . 'category'; ?>">
            <i class="fa fa-address-book-o" aria-hidden="true"></i>
        </a>
    </small>
</h1>

<?php if(!empty($categories)) { ?>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Parent</th>
            <th>Url</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($categories as $category) { ?>
            <?php $index = array_search($category->parent, array_column($categories, 'ID'));  ?>
            <tr>
                <td><?php echo $category->name; ?></td>
                <td><?php echo empty($index) && $category->parent == 0 ? 'Main Category' : $categories[$index]->name; ?></td>
                <td><?php echo $category->url; ?></td>
                <td>
                    <a href="<?php echo ADMIN_URL . 'category/' . $category->ID; ?>">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </td>
                <td>
                    <a href="<?php echo ADMIN_URL . 'category-delete/' . $category->ID; ?>"
                       class="btn btn-danger">
                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php }