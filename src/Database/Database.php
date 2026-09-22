<?php

namespace Nishanrahman\UserManagement\Database;
use PDO;

class Database{
private PDO $pdo;

public function __construct()
{
   $dsn = "mysql:host=" . $_ENV['DB_HOST']
        . ";dbname=" . $_ENV['DB_NAME']
        . ";port=" . $_ENV['DB_PORT']
        . ";charset=utf8mb4";

    $this->pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
   
}

}
