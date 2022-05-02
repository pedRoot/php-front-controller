<?php

namespace Ptorres\PhpMvcComposer\lib;

use PDO;
use PDOException;

class Database
{
    private string $host;
    private string $db;
    private string $user;
    private string $password;
    private string $charset;

    public function __construct()
    {
        $this->host = $_ENV['HOST'];
        $this->db = $_ENV['DB'];
        $this->user = $_ENV['USER'];
        $this->password = $_ENV['PASSWORD'];
        $this->charset = $_ENV['CHARSET'];
    }

    public function conect()
    {
        try {
            $conection = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                $this->host,
                $this->db,
                $this->charset
            );
            $options = [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO(
                $conection,
                $this->user,
                $this->password,
                $options
            );

            return $pdo;
        } catch (PDOException $e) {
            error_log($e);
            throw $e;
        }
    }
}
