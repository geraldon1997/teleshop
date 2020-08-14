<?php
namespace App\Core;

use App\Core\Database;

class Gateway extends Database
{
    private Database $mysqli;

    public function __construct()
    {
        $this->mysqli = new Database();
    }
    
    protected function execute($query)
    {
        $result = $this->mysqli->query($query);
        if (!$result) {
            return false;
        }
        return $result;
    }

    protected function fetch($query)
    {
        $data = [];
        $result = $this->mysqli->query($query);

        if (!$result) {
            return false;
        }

        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }

        return $data;
    }

    protected function check($query)
    {
        $result = $this->mysqli->query($query);
        $exists = $result->num_rows;
        
        if (!$exists) {
            return false;
        }

        return true;
    }
}