<?php

/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 17.05.2017
 * Time: 9:34
 */
class Car extends DatabaseQuery
{
    protected static $db_fields = [
        'ID', 'name', 'url', 'price', 'info', 'added',
        'added_by', 'edited_by', 'status'
    ];

    protected static $table_name = 'cars';

    public $ID;
    public $name;
    public $url;
    public $price;
    public $info;
    public $added;
    public $added_by;
    public $edited_by;
    public $status;
}