# Laravel + React Fullstack Journey - Day 2

## Welcome to Day 2! 🚀

Today we're building on Day 1 foundation. Today we learn:
- **PHP:** Inheritance, Polymorphism, Method Overriding
- **React:** Props Deep Dive, Reusable Components

### Today's Roadmap

| Technology | Time | Focus |
|------------|------|-------|
| Laravel/PHP | 3 hours | Inheritance, Polymorphism |
| React | 1 hour | Props Deep Dive |

**Goal:** Master inheritance for Laravel + build reusable React components

---

## 🎯 Day 2 Outcome

আজকের শেষে তুমি পারবা:

- Inheritance use করে clean code reuse
- Method overriding বুঝতে ও apply করতে
- Polymorphism basics handle করতে
- Parent-child class design করতে
- React props deep understanding
- Dynamic reusable UI blocks বানাতে
- Same data multiple components এ pass করা

---

## 🐘 Part 1: PHP OOP - Inheritance & Polymorphism (3 Hours)

### 🐘 Topic 1: Inheritance

```php
<?php

class User
{
    public $name = "Nirjhor";

    public function getName()
    {
        return $this->name;
    }
}

class Admin extends User
{
}

$admin = new Admin();
echo $admin->getName(); // Nirjhor
```

#### Laravel এ inheritance everywhere:

```php
class Controller extends BaseController {}
class Model extends Eloquent {}
class Mailable extends Mailable {}
```

---

### 🐘 Topic 2: Method Overriding

```php
<?php

class User
{
    public function role() { return "User"; }
}

class Admin extends User
{
    public function role() { return "Admin"; }
}

echo (new Admin())->role(); // Admin
```

---

### 🐘 Topic 3: Parent Keyword

```php
<?php

class User
{
    public function greet() { return "Hello"; }
}

class Admin extends User
{
    public function greet()
    {
        return parent::greet() . ", Admin";
    }
}

echo (new Admin())->greet(); // Hello, Admin
```

---

### 🐘 Topic 4: Polymorphism

```php
<?php

class Payment
{
    public function pay() { return "Base payment"; }
}

class BkashPayment extends Payment
{
    public function pay() { return "Paid via Bkash"; }
}

class CardPayment extends Payment
{
    public function pay() { return "Paid via Card"; }
}

$payments = [new BkashPayment(), new CardPayment()];

foreach ($payments as $payment) {
    echo $payment->pay() . "\n";
}
```

---

### 🐘 Practice Exercise: Notification System

```php
<?php

class Notification
{
    public function send()
    {
        return "Base notification";
    }
}

class EmailNotification extends Notification
{
    public function send()
    {
        return "Email sent successfully";
    }
}

class SMSNotification extends Notification
{
    public function send()
    {
        return "SMS sent successfully";
    }
}

class PushNotification extends Notification
{
    public function send()
    {
        return "Push notification sent successfully";
    }
}

echo (new EmailNotification())->send() . "\n";
echo (new SMSNotification())->send() . "\n";
echo (new PushNotification())->send() . "\n";
```

---

## ⚛️ Part 2: React - Props Deep Dive (1 Hour)

### ⚛️ Topic 1: Dynamic Props

```jsx
function UserCard({ name, role }) {
    return (
        <div>
            <h2>{name}</h2>
            <p>{role}</p>
        </div>
    );
}

<UserCard name="Nirjhor" role="Admin" />
<UserCard name="Sazzad" role="Developer" />
```

---

### ⚛️ Topic 2: Reusable Dashboard Cards

```jsx
function StatCard({ title, count }) {
    return (
        <div>
            <h3>{title}</h3>
            <p>{count}</p>
        </div>
    );
}

<StatCard title="Users" count={120} />
<StatCard title="Jobs" count={500} />
```

---

### ⚛️ Topic 3: Notification Card Component

```jsx
function NotificationCard({ type, message }) {
    return (
        <div>
            <h2>{type}</h2>
            <p>{message}</p>
        </div>
    );
}

<NotificationCard type="Email" message="Email sent successfully" />
<NotificationCard type="SMS" message="SMS sent successfully" />
<NotificationCard type="Push" message="Push notification sent" />
```

---

## Summary

### PHP OOP:
- ✅ Inheritance - child inherits from parent
- ✅ Method Overriding - customize child behavior
- ✅ Parent keyword - extend parent method
- ✅ Polymorphism - same interface, different behavior

### React:
- ✅ Dynamic props - flexible components
- ✅ Reusable dashboard cards pattern
- ✅ Default props
- ✅ Mapping data to components

---

## How to Run

### PHP:
```bash
php php-inheritance/Notification.php
```

### React:
```bash
npx create-react-app my-app
# or
npm create vite@latest my-app -- --template react
```

---

## What's Next? (Day 3)

Tomorrow:
- PHP: Interfaces, Abstract Classes, Traits
- React: State Management with useState

These are critical for Laravel Service Layer!

Keep practicing! 💪