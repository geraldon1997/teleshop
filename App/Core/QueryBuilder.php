<?php
namespace App\Core;

use App\Core\Gateway;

class QueryBuilder extends Gateway
{
    public function create()
    {
        //
    }

    public function insert()
    {
        //
    }

    public function update()
    {
        //
    }

    public function all($table)
    {
        $query = "SELECT * FROM $table ORDER BY `id` DESC";
        return $this->fetch($query);
    }

    public function find($table, $col, $val)
    {
        $query = "SELECT * FROM $table WHERE '$col' = '$val' ";
        return $this->fetch($query);
    }

    public function exists($table, $col, $val)
    {
        $query = "SELECT * FROM $table WHERE '$col' = '$val' ";
        return $this->check($query);
    }

    public function delete($table, $col, $val)
    {
        $query = "DELETE FROM $table WHERE '$col' = '$val' ";
        return $this->fetch($query);
    }
}