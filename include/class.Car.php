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
        'ID', 'name', 'url', 'price', 'info', 'added', 'added_by', 'edited_by', 'status'
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

    public function urlSlug($name) {

        $url = url_slug($name);

        $shuffel = "qwertyuiopasdfghjklzxcvbnm1234567890";

        do {
            $this->url = $url . "-" . substr(str_shuffle($shuffel), 0, 3);
        } while(Category::findCategoryByUrl($this->url));

        return $this->url;
    }

    public static function findBySearach($s) {

        if (strlen($s) < 3) {
            return "Search must be longer than 3 characters";
        }

        global $database;

        $sql = "SELECT * FROM " . PX . self::$table_name
            . " WHERE name LIKE '%" . $database->escape_value($s) . "%'";

        $result = static::find_by_query($sql);

        return !empty($result) ? $result : false;
    }
}