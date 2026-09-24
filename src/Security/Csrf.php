<?php
namespace Nishanrahman\UserManagement\Security;

class Csrf{
public function token():string{
    return bin2hex(random_bytes(32));
}
}