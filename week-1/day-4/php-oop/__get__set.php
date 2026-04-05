<?php

class User
{
    private array $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
}

$user = new User();
$user->name = "Nirjhor"; //very important there is no name variable in class
$user->email = "nirjhor@example.com";

echo $user->name;   // Nirjhor
echo $user->email;  // nirjhor@example.com