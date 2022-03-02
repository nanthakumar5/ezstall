<?php
namespace App\Models;

class BaseModel 
{
    public function __construct()
    {
        $this->db = db_connect();
	}
}
