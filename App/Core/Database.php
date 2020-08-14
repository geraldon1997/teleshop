<?php
namespace App\Core;

use mysqli;

class Database extends mysqli
{
    public function __construct()
    {
        return new mysqli('localhost','root','','bossearn');
    }
}