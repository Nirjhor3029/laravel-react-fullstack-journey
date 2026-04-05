<?php
class User{
    public $name;
    public $email;
    public $password;
    public $age;

    public function __construct($age){
        
        $this->age = 20;
    }

    public function setName(){
        $this->name = "Sazzad Hossain Nirjhor";
    }
}

$user = new User(25);
// $user->setName();
echo 'Name: '.$user->name;
echo '<br> Age: '.$user->age;