<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 13.09.2017
 * Time: 15:32
 */

require_once "../../include/autoload.php";

$s = filter_input(INPUT_POST, 's', FILTER_SANITIZE_STRING);

if (isset($s) && !empty($s)) : ?>
    <h3>Search: <small><?php echo "$s"; ?></small></h3>
    <?php $cars = Car::findBySearach($s); ?>
    <ul class="list-unstyled">
        <?php if (!empty($cars)) : foreach ($cars as $car) : ?>
            <li class="media">
                <img class="d-flex mr-3" width="100" src="<?php echo TEMPLATE_URL ?>/images/No_image_available.svg" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0 mb-1"><?php echo ucfirst(strtolower($car->name)); ?></h5>
                    <?php echo $car->info ?>
                    <h6>Price: <?php echo $car->price; ?></h6>
                </div>
            </li>
        <?php endforeach; endif; ?>
    </ul>
<?php endif; ?>