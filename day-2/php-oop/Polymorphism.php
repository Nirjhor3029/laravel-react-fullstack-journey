<?php

/*
    📚 Topic 4: Polymorphism Intro
    Same method → different behavior.
*/

class Payment2
{
    public function pay()
    {
        return "Base payment";
    }
}

class BkashPayment extends Payment2
{
    public function pay()
    {
        return "Paid via Bkash";
    }
}

class CardPayment extends Payment2
{
    public function pay()
    {
        return "Paid via Card";
    }
}

class Test
{
    public function testFunction()
    {
        $payments = [
            new BkashPayment(),
            new CardPayment()
        ];
        foreach ($payments as $payment) {
            echo $payment->pay()."<br>";
        }
    }
}

$test = new Test();
$test->testFunction();