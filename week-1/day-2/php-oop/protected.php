<?php

class Animal
{
    protected $name = 'Animal';  // Accessible in child, not outside

    public function getName()
    {
        return $this->name;
    }
}

class Dog extends Animal
{
    public function setName($name)
    {
        $this->name = $name;  // Protected is accessible here
    }

    public function display()
    {
        return "Dog name: " . $this->name;
    }
}

$dog = new Dog();
// $dog->setName('Buddy');
echo $dog->display(); // Dog name: Buddy
// echo $dog->name; // Error! Protected not accessible outside