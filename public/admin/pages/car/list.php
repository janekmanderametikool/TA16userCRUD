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


$cars = Car::find_all();

//TODO make 3 type categories: select, checkbox, input

?>

<h1 class="text-right">
    <?php echo $page['name'] ?>
    <small>
        <a href="<?php echo ADMIN_URL . 'car'; ?>">
            <i class="fa fa-car" aria-hidden="true"></i>
        </a>
    </small>
</h1>

<?php if(!empty($cars)) { ?>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Url</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($cars as $car) { ?>

            <tr>
                <td><?php echo $car->name; ?></td>
                <td><?php echo $car->price ?></td>
                <td><?php echo $car->url; ?></td>
                <td>
                    <a href="<?php echo ADMIN_URL . 'car/' . $car->ID; ?>">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </td>
                <td>
                    <a href="<?php echo ADMIN_URL . 'car-delete/' . $car->ID; ?>"
                       class="btn btn-danger">
                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php }