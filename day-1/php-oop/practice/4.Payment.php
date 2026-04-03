<?php

class Payment
{
    private $amount;
    private $customerName;
    private $currency;
    private $transactionId;

    public function __construct($amount, $customerName, $currency = 'BDT')
    {
        $this->amount = $amount;
        $this->customerName = $customerName;
        $this->currency = $currency;
        $this->transactionId = uniqid('TXN_');
    }

    public function pay()
    {
        return "Paid {$this->amount} {$this->currency}";
    }

    public function getSummary()
    {
        return [
            'transaction_id' => $this->transactionId,
            'customer' => $this->customerName,
            'amount' => $this->amount,
            'currency' => $this->currency
        ];
    }
}

// Usage
$payment = new Payment(5000, 'Nirjhor', 'BDT');
echo $payment->pay();
// Output: Paid 5000 BDT
echo "<br>";

print_r($payment->getSummary());
// Output: Array ( [transaction_id] => TXN_abc123, [customer] => Nirjhor, [amount] => 5000, [currency] => BDT )