<?php

class Wallet
{
    private $balance = 0;

    public function deposit($amount)
    {
        if ($amount > 0) {
            $this->balance += $amount;
            return true;
        }
        return false;
    }

    public function withdraw($amount)
    {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            return true;
        }
        return false;
    }

    public function getBalance()
    {
        return $this->balance;
    }
}

$wallet = new Wallet();
$wallet->deposit(1000);
echo $wallet->getBalance(); // 1000
$wallet->withdraw(300);
echo $wallet->getBalance(); // 700