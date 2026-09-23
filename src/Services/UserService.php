<?php
namespace Nishanrahman\UserManagement\Services;
use Nishanrahman\UserManagement\Repositories\UserRepository;
class UserService{
private UserRepository $repository;

public function __construct(UserRepository $repository)
{
    $this->repository= $repository;
}

public function getAllUsers(){
    return $this->repository->getAllUsers();
}

public function createUser(string $name,string $email,int $age){
    $name = trim($name);
    $email = trim($email);

    if($name=== ""){
        return "Name can not be empty";
    }
    elseif(strlen($name)<3){
        return "Name should be at least 3 character";
    }
    elseif(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
        return "Email is not valid";
    }elseif( $this->repository->findByEmail($email)){
        return "Email already exists";
    }
    elseif($age<18){
        return "Age should be at least 18";
    }
    else{
        return $this->repository->createUser($name,$email,$age);
    }

}

}