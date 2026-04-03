<?php
class User{
    public $name;
    public $email;
    public $password;

    public function setName(){
        $this->name = "Sazzad Hossain Nirjhor";
    }
}

$user = new User();
// $user->setName();
echo $user->name;