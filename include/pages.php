<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 18.05.2017
 * Time: 9:03
 */

$pages = [
    'admin' => [
        'path' => ADMIN_PATH . 'pages/admin.php',
        'name' => 'Admin',
        'menu' => 'admin'
    ],
    'user' => [
        'path' => ADMIN_PATH . 'pages/user/user.php',
        'name' => 'User',
        'menu' => 'user'
    ],
    'user-list' => [
        'path' => ADMIN_PATH . 'pages/user/list.php',
        'name' => 'User list',
        'menu' => 'user-list'
    ],
    'user-delete' => [
        'path' => ADMIN_PATH. 'pages/user/delete.php',
        'name' => 'User delete',
        'menu' => 'user-delete'
    ],
    'category' => [
        'path' => ADMIN_PATH . 'pages/category/category.php',
        'name' => 'Category',
        'menu' => 'category'
    ],
    'category-list' => [
        'path' => ADMIN_PATH . 'pages/category/list.php',
        'name' => 'Category list',
        'menu' => 'category-list'
    ],
    'category-delete' => [
        'path' => ADMIN_PATH. 'pages/category/delete.php',
        'name' => 'Category delete',
        'menu' => 'category-delete'
    ],
    'car' => [
        'path' => ADMIN_PATH . 'pages/car/car.php',
        'name' => 'Car',
        'menu' => 'car'
    ],
    'car-list' => [
        'path' => ADMIN_PATH . 'pages/car/list.php',
        'name' => 'Car list',
        'menu' => 'car-list'
    ],
    'car-delete' => [
        'path' => ADMIN_PATH. 'pages/car/delete.php',
        'name' => 'Car delete',
        'menu' => 'car-delete'
    ],
    '404' => [
        'path' => MAIN_PATH . '404.php',
        'name' => '404',
        'menu' => '404'
    ],
];