<?php

use Dotenv\Dotenv;
use Nishanrahman\UserManagement\Database\Database;
use Nishanrahman\UserManagement\Repositories\UserRepository;

require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$database = new Database();

$pdo = $database->getConnection();

echo "PDO connection received successfully!";

$userRepository = new UserRepository($pdo);
$users = $userRepository->getAllUsers();

echo "<pre>";
print_r($users);
echo "</pre>";