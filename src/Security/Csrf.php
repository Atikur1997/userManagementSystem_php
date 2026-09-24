<?php
namespace Nishanrahman\UserManagement\Security;

class Csrf{
public static function token():string{
    if(!isset($_SESSION['csrf_token'])){
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));

    }
    return $_SESSION['csrf_token'];
}
public static function varify(string $submittedToken):bool{
    $sessionToken = $_SESSION['csrf_token'] ?? "";
    return hash_equals($sessionToken,$submittedToken);
}
}