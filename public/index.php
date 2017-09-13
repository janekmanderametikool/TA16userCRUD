<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 10.05.2016
 * Time: 9:10
 */
require_once "../include/autoload.php";



get_template('head'); ?>

<?php $s = filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING); ?>

<div class="container">
    <h1>Public page <i class="fa fa-address-book" aria-hidden="true"></i></h1>

    <div class="row">
        <div class="col-sm-4">
            <form class="form-inline">
                <input type="text" class="form-control" name="s" id="s" placeholder="Search"
                       value="<?php echo isset($s) ? $s : ''; ?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="col-sm-8">
            <div id="search-results">
            <?php if (isset($s) && !empty($s)) : ?>
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
            </div>
        </div>
    </div>
</div>

<?php get_template('footer');