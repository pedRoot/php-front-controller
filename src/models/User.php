<?php

namespace Ptorres\PhpMvcComposer\models;

use PDO;
use PDOException;
use Ptorres\PhpMvcComposer\lib\Model;
use Ptorres\PhpMvcComposer\lib\Database;

class User extends Model
{
    private int $id;
    private array $posts;
    private string $profile;

    public function __construct(
        private string $username,
        private string $password
    ) {
        parent::__construct();

        $this->id = -1;
        $this->posts = [];
        $this->profile = "";
    }

    public function save()
    {
        //TODO
        //Validar que exista el usuario
        try {
            $query = $this->prepare(
                'INSERT INTO users (username, password, profile) VALUES (:username, :password, :profile);'
            );
            $query->execute([
                'username'  => $this->username,
                'password'  => $this->getHashPassword($this->password),
                'profile'  => $this->profile,
            ]);
            return true;
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    private function getHashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, [
            'cost' => 10,
        ]);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $value)
    {
        $this->id = $value;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setPosts($value)
    {
        $this->posts = $value;
    }

    public function setProfile($value)
    {
        $this->profile = $value;
    }

    public function getProfile()
    {
        return $this->profile;
    }
}
