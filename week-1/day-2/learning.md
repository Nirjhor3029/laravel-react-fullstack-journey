# Laravel + React Fullstack Journey - Day 2

## Welcome to Day 2! 🚀

Today we're building on Day 1 foundation and learning two critical concepts: **Inheritance + Polymorphism** (PHP) and **Props Deep Dive** (React).

### Today's Roadmap

| Technology | Time | Focus |
|------------|------|-------|
| Laravel/PHP | 3 hours | Inheritance, Polymorphism, Method Overriding |
| React | 1 hour | Props Deep Dive, Reusable Components |

**Goal:** Master inheritance for Laravel architecture + build reusable React components

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

### 🐘 Topic 1: Inheritance - Code Reuse The Right Way

**Inheritance** allows a class to inherit properties and methods from another class. This is the foundation of Laravel's architecture.

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

// Admin inherits from User - gets all User properties and methods
class Admin extends User
{
}

$admin = new Admin();
echo $admin->getName(); // Output: Nirjhor
```

#### Why This Matters for Laravel:

Laravel uses inheritance everywhere:

```php
// Laravel's actual code works like this:
class Controller extends BaseController {}  // All controllers inherit
class Model extends Eloquent {}               // All models inherit
class Mailable extends Mailable {}           // All mailables inherit
class Command extends SymfonyCommand {}      // All commands inherit
```

#### Key Terminology:

| Term | Definition |
|------|------------|
| **Parent Class** (Base/Super) | The class being inherited from |
| **Child Class** (Subclass) | The class that inherits |
| **extends** | Keyword to create inheritance |

---

### 🐘 Topic 2: Method Overriding - Customize Child Behavior

Child class can change (override) parent method behavior.

```php
<?php

class User
{
    public function role()
    {
        return "User";
    }
}

class Admin extends User
{
    // Override the parent's role() method
    public function role()
    {
        return "Admin";
    }
}

class Developer extends User
{
    public function role()
    {
        return "Developer";
    }
}

$user = new User();
$admin = new Admin();
$dev = new Developer();

echo $user->role();   // User
echo $admin->role();  // Admin
echo $dev->role();    // Developer
```

**Why Use It:** Same method name, different behavior based on the class.

---

### 🐘 Topic 3: Parent Keyword - Extend, Not Replace

Use `parent::` to call parent method and add more functionality.

```php
<?php

class User
{
    public function greet()
    {
        return "Hello";
    }
}

class Admin extends User
{
    public function greet()
    {
        // Call parent's greet() and add more
        return parent::greet() . ", Admin";
    }
}

$admin = new Admin();
echo $admin->greet(); // Hello, Admin
```

**Use Case:** When you want to keep parent's logic but add extra behavior.

---

### 🐘 Topic 4: Polymorphism - One Interface, Many Behaviors

**Polymorphism** means "many forms" - same method signature, different implementation.

```php
<?php

class Payment
{
    public function pay()
    {
        return "Base payment";
    }
}

class BkashPayment extends Payment
{
    public function pay()
    {
        return "Paid via Bkash";
    }
}

class CardPayment extends Payment
{
    public function pay()
    {
        return "Paid via Card";
    }
}

class NagadPayment extends Payment
{
    public function pay()
    {
        return "Paid via Nagad";
    }
}

// Same method, different behaviors
$payments = [
    new BkashPayment(),
    new CardPayment(),
    new NagadPayment()
];

foreach ($payments as $payment) {
    echo $payment->pay() . "\n";
}

/*
Output:
Paid via Bkash
Paid via Card
Paid via Nagad
*/
```

#### Real World Application:

```php
<?php

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
    echo $notification->send() . "\n";
}
```

---

### 🐘 Practice Exercise: Build a Notification System

Create this inheritance hierarchy:

```php
<?php

// Base class
class Notification
{
    public function send()
    {
        return "Base notification sent";
    }
}

// Child classes - each overrides send()
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

// Test your code
echo (new EmailNotification())->send() . "\n";
echo (new SMSNotification())->send() . "\n";
echo (new PushNotification())->send() . "\n";

/*
Expected Output:
Email sent successfully
SMS sent successfully
Push notification sent successfully
*/
```

**Save as:** `php-inheritance/Notification.php`

**Run:** `php php-inheritance/Notification.php`

---

### 🐘 Constructor in Inheritance

```php
<?php

class User
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

class Admin extends User
{
    public $level;

    public function __construct($name, $level = 'super')
    {
        parent::__construct($name);  // Call parent constructor
        $this->level = $level;
    }

    public function info()
    {
        return "Admin: {$this->name}, Level: {$this->level}";
    }
}

$admin = new Admin('Nirjhor', 'super');
echo $admin->info(); // Admin: Nirjhor, Level: super
```

---

### 🐘 Protected - Access in Child Classes Only

```php
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
$dog->setName('Buddy');
echo $dog->display(); // Dog name: Buddy
// echo $dog->name; // Error! Protected not accessible outside
```

---

## ⚛️ Part 2: React - Props Deep Dive (1 Hour)

### ⚛️ Topic 1: Dynamic Props - Make Components Flexible

Props make components reusable by accepting dynamic data.

```jsx
function UserCard({ name, role }) {
    return (
        <div className="card">
            <h2>{name}</h2>
            <p>Role: {role}</p>
        </div>
    );
}

function App() {
    return (
        <div>
            <UserCard name="Nirjhor" role="Admin" />
            <UserCard name="Sazzad" role="Developer" />
            <UserCard name="Rahim" role="Designer" />
        </div>
    );
}
```

**Key Insight:** Same component, different data = reusable UI

---

### ⚛️ Topic 2: Reusable Dashboard Cards

Professional React uses this pattern for dashboards:

```jsx
function StatCard({ title, count, icon }) {
    return (
        <div className="stat-card">
            <span className="icon">{icon}</span>
            <h3>{title}</h3>
            <p className="count">{count}</p>
        </div>
    );
}

function Dashboard() {
    return (
        <div className="dashboard">
            <StatCard title="Users" count={120} icon="👥" />
            <StatCard title="Jobs" count={500} icon="💼" />
            <StatCard title="Applications" count={1250} icon="📝" />
            <StatCard title="Companies" count={45} icon="🏢" />
        </div>
    );
}
```

---

### ⚛️ Topic 3: Notification Card Component

Let's build the UI for the PHP notification system:

```jsx
function NotificationCard({ type, message, status }) {
    return (
        <div className={`notification-card ${status}`}>
            <h2>{type}</h2>
            <p>{message}</p>
        </div>
    );
}

function App() {
    const notifications = [
        { type: 'Email', message: 'Email sent successfully', status: 'success' },
        { type: 'SMS', message: 'SMS sent successfully', status: 'success' },
        { type: 'Push', message: 'Push notification sent', status: 'success' }
    ];

    return (
        <div className="notification-list">
            {notifications.map((notif, index) => (
                <NotificationCard 
                    key={index}
                    type={notif.type}
                    message={notif.message}
                    status={notif.status}
                />
            ))}
        </div>
    );
}
```

---

### ⚛️ Topic 4: Default Props

```jsx
function Button({ text = 'Click Me', type = 'primary' }) {
    return <button className={`btn btn-${type}`}>{text}</button>;
}

// Usage
<Button />                              // Click Me (default)
<Button text="Submit" />                // Submit
<Button text="Cancel" type="danger" /> // Cancel
```

---

### ⚛️ Practice Exercise: Notification UI

Create these components:

```jsx
// Component 1: NotificationCard
function NotificationCard({ type, message }) {
    return (
        <div className="notification-card">
            <h2>{type}</h2>
            <p>{message}</p>
        </div>
    );
}

// Component 2: App using multiple NotificationCards
function App() {
    return (
        <div className="notifications">
            <NotificationCard 
                type="Email" 
                message="Email sent successfully" 
            />
            <NotificationCard 
                type="SMS" 
                message="SMS sent successfully" 
            />
            <NotificationCard 
                type="Push" 
                message="Push notification sent" 
            />
        </div>
    );
}

export default App;
```

---

## 🔥 Full Mini Project: Multi Notification Preview System

### PHP Side:
1. Create `Notification.php` with parent class
2. Create `EmailNotification`, `SMSNotification`, `PushNotification` children
3. Each overrides `send()` method

### React Side:
1. Create `NotificationCard` component
2. Use it multiple times with different props
3. Map through an array of notification data

---

## 📝 GitHub Folder Structure

```
day-2/
├── php-inheritance/
│   └── Notification.php
├── learning.md
├── readme.md
└── interview-qa.md
```

**Commit:**
```bash
git add .
git commit -m "Day 2: inheritance polymorphism and reusable React props"
```

---

## Summary - What You Learned Today

### PHP OOP:
- ✅ Inheritance - child inherits from parent
- ✅ Method Overriding - customize child behavior
- ✅ Parent keyword - extend parent method
- ✅ Polymorphism - same interface, different behavior
- ✅ Protected access modifier

### React:
- ✅ Dynamic props - flexible components
- ✅ Reusable dashboard cards pattern
- ✅ Default props
- ✅ Mapping data to components

---

## How to Run Your Code

### PHP:
```bash
php php-inheritance/Notification.php
```

### React:
1. Create: `npx create-react-app react-notification-ui`
2. Or: `npm create vite@latest react-notification-ui -- --template react`
3. Edit `src/App.jsx`
4. Run: `npm run dev`

---

## What's Next? (Day 3 Preview)

Tomorrow we'll dive into:
- **PHP:** Interfaces, Abstract Classes, Traits
- **React:** State Management with useState

These are critical for Laravel Service Layer and building interactive React apps!

Keep practicing! 💪