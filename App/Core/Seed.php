<?php
namespace App\Core;

use App\Core\QueryBuilder;

class Seed extends  QueryBuilder
{
    public static $ai = "AUTO_INCREMENT";
    public static $pk = "PRIMARY KEY";
    public static $int = "INT";
    public static $var = "VARCHAR";

    public static function createUserTable()
    {
        $query = "
            id INT PRIMARY KEY AUTO_INCREMENT
        ";
    }
}