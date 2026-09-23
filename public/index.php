<?php

use Dotenv\Dotenv;
use Nishanrahman\UserManagement\Database\Database;
use Nishanrahman\UserManagement\Repositories\UserRepository;
use Nishanrahman\UserManagement\Services\UserService;

require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$database = new Database();

$pdo = $database->getConnection();

echo "PDO connection received successfully!";

$userRepository = new UserRepository($pdo);
$userService = new UserService($userRepository);





