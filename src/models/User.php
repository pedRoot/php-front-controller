<?php

namespace Ptorres\PhpMvcComposer\models;

use PDO;
use Exception;
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

    public function save(): bool
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
        } catch (PDOException | Exception $e) {
            error_log($e);
            return false;
        }
    }

    public static function exists(string $username): bool
    {
        try {
            $db = new Database();

            $query = $db->conect()->prepare(
                'SELECT username FROM users where username = :username;'
            );
            $query->execute(['username'  => $username]);

            if ($query->rowCount() < 0) {
                throw new Exception("ERROR - User/exists: User not found!!!");
            }

            return true;
        } catch (PDOException | Exception $e) {
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

    public function comparePassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public static function get(string $username): User
    {
        try {
            $db = new Database();

            $query = $db->conect()->prepare(
                'SELECT * FROM users where username = :username;'
            );
            $query->execute(['username'  => $username]);

            if ($query->rowCount() < 0) {
                throw new Exception("ERROR - User/get: User not found!!!");
            }

            $dataUser = $query->fetch();
            $user = new User($dataUser['username'], $dataUser['password']);
            $user->setId($dataUser['user_id']);
            $user->setProfile($dataUser['profile']);

            return $user;
        } catch (PDOException | Exception $e) {
            error_log($e);
            return false;
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $value)
    {
        $this->id = $value;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPosts(): array
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

    public function getProfile(): string
    {
        return $this->profile;
    }
}
