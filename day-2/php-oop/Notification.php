<?php

/*
🐘 Topic 4: Polymorphism - One Interface, Many Behaviors
Polymorphism means "many forms" - same method signature, different implementation.
*/

// Notification System Example
class Notification
{
    protected $recipient;

    public function __construct($recipient)
    {
        $this->recipient = $recipient;
    }

    public function send()
    {
        return "Sending notification";
    }
}

class EmailNotification extends Notification
{
    public function send()
    {
        return "Email sent to {$this->recipient}";
    }
}

class SMSNotification extends Notification
{
    public function send()
    {
        return "SMS sent to {$this->recipient}";
    }
}

class PushNotification extends Notification
{
    public function send()
    {
        return "Push notification sent to {$this->recipient}";
    }
}

// All can be treated as Notification
$notifications = [
    new EmailNotification('nirjhor@example.com'),
    new SMSNotification('+8801234567890'),
    new PushNotification('device_token_123')
];

foreach ($notifications as $notification) {
    echo $notification->send() . "<br>";
}