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

//admin/category-list/10
//admin/index.php?page=category-list&ID=10
$page = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_INT);

if (empty($page)) {
    $page = 1;
}
//page 1 -> 0, 5
//page 2 -> 5, 5
//page 3 -> 10, 5
//page 4 -> 15, 5
// kui page 1 -> 0
// kui page 2 -> 5 => 0 + max
// kui page 3 -> 10 => 0*3 + max
// y = pageStart + max
/*
    0, max => 1
    max, max => 2
    max+max, max => 3
    max+max+max, max => 4

    (page-1)*max

*/
$next = $page+1;
$last = $page-1;
$countCategories = Category::count_all();

$maxPages = ceil($countCategories / MAX_ITEMS_ON_PAGE);

$categories = Category::findCategories(0, $last*MAX_ITEMS_ON_PAGE, MAX_ITEMS_ON_PAGE);

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
<?php } ?>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        <li class="page-item <?php echo $last != 0 ? '' : 'disabled'; ?>">
            <a class="page-link" href="<?php echo ADMIN_URL; ?>category-list/<?php echo $last; ?>" tabindex="-1">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item <?php echo $maxPages >= $next ? '' : 'disabled'; ?>">
            <a class="page-link" href="<?php echo ADMIN_URL; ?>category-list/<?php echo $next; ?>">Next</a>
        </li>
    </ul>
</nav>