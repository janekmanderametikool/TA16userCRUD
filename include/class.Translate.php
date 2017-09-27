<?php
/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 27.09.2017
 * Time: 13:35
 */

class Translate extends DatabaseQuery
{
    protected static $db_fields = [
        'ID', 'table_id', 'class', 'keyword', 'translation', 'language', 'added'
    ];

    protected static $table_name = 'translations';

    public $ID;
    public $table_id;
    public $class;
    public $keyword;
    public $translation;
    public $language;
    public $added;

    public static function getTranslation($table_id, $class, $keyword, $language) {
        global $database;

        $sql = "SELECT * FROM " . PX . self::$table_name
            . " WHERE table_id=" . $database->escape_value($table_id)
            . " AND class='" . $database->escape_value($class) . "'"
            . " AND keyword='" . $database->escape_value($keyword) . "'"
            . " AND language='" . $database->escape_value($language) . "'";

        $result = static::find_by_query($sql);

        return !empty($result) ? array_shift($result) : false;
    }

    public static function getTranslations($table_id = 0, $class, $language) {
        global $database;

        $sql = "SELECT * FROM " . PX . self::$table_name
            . " WHERE table_id=" . $database->escape_value($table_id)
            . " AND class='" . $database->escape_value($class) . "'"
            . " AND language='" . $database->escape_value($language) . "'";

        $result = static::find_by_query($sql);

        return !empty($result) ? $result : false;
    }

    public static function t($obj, $keyword, $translations) {

        if (getLanguage() == 'en') {
            return isset($obj->$keyword) ? $obj->$keyword : '';
        }

        $key = array_search($keyword, array_column($translations, 'keyword'));

        if (empty($key) && $key !== 0) {
            return "";
        }

        return $translations[$key]->translation;
    }
}