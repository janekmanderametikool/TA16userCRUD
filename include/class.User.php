<?php

/**
 * Created by PhpStorm.
 * User: janek.mander
 * Date: 17.05.2017
 * Time: 9:34
 */
class User extends DatabaseQuery
{
    protected static $db_fields = [
        'ID', 'username', 'password', 'group_rights', 'last_login',
        'added', 'added_by', 'edited_by', 'status'
    ];

    protected static $table_name = 'users';

    public $ID;
    public $username;
    public $password;
    public $group_rights;
    public $last_login;
    public $added;
    public $added_by;
    public $edited_by;
    public $status;

    public static function has_access() {
        return true;
    }

    public static function findByUsername($username) {
        global $database;

        $query = "SELECT * FROM " . PX . self::$table_name
            ." WHERE username='" . $database->escape_value($username) . "'";

        $results = self::find_by_query($query);


        return empty($results) ? false : array_shift($results);
    }

    public static function auth($username, $password) {
        global $database;

        $user = self::findByUsername($username);
        if(!$user) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            return $user;
        }

        return false;

    }
}