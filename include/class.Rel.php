<?php

/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 17.05.2017
 * Time: 9:34
 */
class Rel extends DatabaseQuery
{
    protected static $db_fields = [
        'ID', 'car_id', 'category_id', 'added'
    ];

    protected static $table_name = 'car_cat_rel';

    public $ID;
    public $car_id;
    public $category_id;
    public $added;

    public static function findByCar($car_id = 0) {
        if (empty($car_id)) {
            return [];
        }

        global $database;

        $sql = "SELECT * FROM " . PX . self::$table_name
            . " WHERE car_id = " . $database->escape_value($car_id);

        $result = static::find_by_query($sql);

        return !empty($result) ? $result : false;
    }

    public static function deleteByCar($car_id = 0) {
        if (empty($car_id)) {
            return;
        }

        global $database;

        $sql = "DELETE FROM " . PX . self::$table_name
            . " WHERE car_id = " . $database->escape_value($car_id);

        $database->query($sql);

        return $database->check_last_query() == 1 ? true : false;
    }

}