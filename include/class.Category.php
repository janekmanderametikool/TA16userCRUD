<?php

/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 17.05.2017
 * Time: 9:34
 */
class Category extends DatabaseQuery
{
    protected static $db_fields = [
        'ID', 'name', 'url', 'parent', 'added',
        'added_by', 'edited_by', 'status'
    ];

    protected static $table_name = 'categories';

    public $ID;
    public $name;
    public $url;
    public $parent;
    public $added;
    public $added_by;
    public $edited_by;
    public $status;

    public static function findCategories($ID = 0) {
        global $database;

        $sql = "SELECT * FROM " . PX . self::$table_name;
            $sql.= empty($ID) ? "" : " WHERE ID != " . $database->escape_value($ID);

        $result = static::find_by_query($sql);

        return !empty($result) ? $result : false;
    }

    public static function findCategoriesByParent($ID) {
        global $database;

        $sql = "SELECT * FROM " . PX . self::$table_name
            . " WHERE parent = " . $database->escape_value($ID);

        $result = static::find_by_query($sql);

        return !empty($result) ? $result : false;
    }

    public static function findCategoryByUrl($url) {
        global $database;

        $sql = "SELECT * FROM " . PX . self::$table_name
            . " WHERE url = '" . $database->escape_value($url)
            . "' LIMIT 1";

        $result = static::find_by_query($sql);

        return !empty($result) ? array_shift($result) : false;
    }

    public function urlSlug($name) {

        $url = url_slug($name);

        $shuffel = "qwertyuiopasdfghjklzxcvbnm1234567890";

        do {
            $this->url = $url . "-" . substr(str_shuffle($shuffel), 0, 3);
        } while(Category::findCategoryByUrl($this->url));

        return $this->url;
    }

    public static function findMainCategories() {

        $sql = "SELECT * FROM " . PX . self::$table_name
            . " WHERE parent = 0";

        $result = static::find_by_query($sql);

        return !empty($result) ? $result : false;
    }
}