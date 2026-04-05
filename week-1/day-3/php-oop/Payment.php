<?php

// 1. Create Interface
interface PaymentGateway
{
    public function pay($amount);
    public function getName();
}

// 2. Create Classes that implement the interface
class BkashPayment implements PaymentGateway
{
    public function pay($amount)
    {
        return "Paid {$amount} via Bkash";
    }
    
    public function getName()
    {
        return "Bkash";
    }
}

class NagadPayment implements PaymentGateway
{
    public function pay($amount)
    {
        return "Paid {$amount} via Nagad";
    }
    
    public function getName()
    {
        return "Nagad";
    }
}

class CardPayment implements PaymentGateway
{
    public function pay($amount)
    {
        return "Paid {$amount} via Card";
    }
    
    public function getName()
    {
        return "Credit Card";
    }
}

// 3. Test your code
echo (new NagadPayment())->pay(1000) . "\n";  // Paid 1000 via Nagad

// 4. Test polymorphism
$gateways = [
    new BkashPayment(),
    new NagadPayment(),
    new CardPayment()
];

foreach ($gateways as $gateway) {
    echo $gateway->getName() . ": " . $gateway->pay(500) . "\n";
}

/*
Expected Output:
Paid 1000 via Nagad
Bkash: Paid 500 via Bkash
Nagad: Paid 500 via Nagad
Credit Card: Paid 500 via Card
*/