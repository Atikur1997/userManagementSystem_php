<?php

namespace Nishanrahman\UserManagement\Database;
use PDO;
use RuntimeException;
use PDOException;

class Database{
private PDO $pdo;

public function __construct()
{
   $dsn = "mysql:host=" . $_ENV['DB_HOST']
        . ";dbname=" . $_ENV['DB_NAME']
        . ";port=" . $_ENV['DB_PORT']
        . ";charset=utf8mb4";

    try{
        $this->pdo = new PDO(
            $dsn,
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD']
        ) ;
    }
    catch(PDOException $e){
        error_log($e->getMessage());
    throw new RuntimeException(
        "Database Connection Failed",
        0,
        $e
    );
    }
   
}
public function getConnection(): PDO{
    return $this->pdo;
}

}
