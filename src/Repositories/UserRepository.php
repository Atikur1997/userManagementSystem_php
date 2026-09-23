<?php

namespace Nishanrahman\UserManagement\Repositories;

use PDO;

class UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function getAllUsers(): array
    {

        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE Email= :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function createUser(
        string $name,
    string $email,
    int $age

    ): string
    {
    $stmt = $this->pdo->prepare("INSERT iNTO users (name, email, age) VALUES (:name, :email, :age)");
    $stmt ->execute([
        "name"=> $name,
        "email" => $email,
        "age" => $age
    ]);

    return $this->pdo->lastInsertId();
    }
}