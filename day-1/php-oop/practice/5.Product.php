<?php
Class Product{
    public $name;
    public $price;
    public $quantity;

    public function __construct($name, $price, $quantity){
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getTotalPrice(){
        return $this->price * $this->quantity;
    }

    public function displayInfo(){
        echo "Name: " . $this->name . "<br>";
        echo "Price: $" . $this->price . "<br>";
        echo "Quantity: " . $this->quantity . "<br>";
        echo "Total Price: $" . $this->getTotalPrice() . "<br>";
    }
}

$laptop = new Product('Laptop', 999, 2);
echo $laptop->displayInfo();