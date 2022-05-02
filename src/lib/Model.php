<?php

namespace Ptorres\PhpMvcComposer\lib;

use Ptorres\PhpMvcComposer\lib\Database;

class Model
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function query($query)
    {
        return $this->db->conect()->query($query);
    }

    public function prepare($query)
    {
        return $this->db->conect()->prepare($query);
    }
}
