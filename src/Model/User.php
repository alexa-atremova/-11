<?php

namespace App\Model;

use App\Exception\ValidationException;
use App\Traits\DB;

class User
{
    use DB;

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;
    public const TABLE = 'users';

    private string $name;
    private string $email;
    private string $password;
    private int $status;
    private \DateTime $createdAt;

    public function __construct(
        string $name,
        string $email,
        string $password
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->setPassword($password);
        $this->status = self::STATUS_ACTIVE;
        $this->createdAt = new \DateTime();
    }

    public static function findAll()
    {
        $db = self::getDb();
        $stm = $db->query('SELECT * FROM ' . static::TABLE);
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function findById(int $id): array
    {
        $db = self::getDb();
        $stm = $db->prepare('SELECT * FROM users WHERE id = ?');
        $stm->execute([$id]);
        $result = $stm->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    public static function findByEmail(string $email)
    {
        $db = self::getDb();
        $stm = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stm->execute([$email]);
        $user = $stm->fetch(\PDO::FETCH_ASSOC);
        return $user ? $user : [];
    }

    public static function save(User $user)
    {
        $db = self::getDb();
        $check = self::findByEmail($user->getEmail());
        if ($check) {
            throw new ValidationException(['email' => "Email already exist"]);
        }
        $stm = $db->prepare('
            INSERT INTO users (`name`,email,password,status,created_at)
            VALUE (?,?,?,?,?)
        ');

        $stm->execute([
            $user->getName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getStatus(),
            $user->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }


    public static function remove(int $id)
    {
        $db = self::getDb();
        $stm = $db->prepare('DELETE FROM users WHERE id = ?');
        $stm->execute([$id]);
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }


    public function setPassword(string $password): void
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if (is_string($hash)) {

            $this->password = $hash;

        }
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }


}