# Laravel + React Fullstack Journey - Day 1

## Welcome to Mentorship Mode! 🚀

Welcome to Day 1 of your fullstack journey! Today we're building the foundation.

### Today's Roadmap

| Technology | Time | Focus |
|------------|------|-------|
| Laravel/PHP | 3 hours | OOP Foundation |
| React | 1 hour | JSX + Components |

**Goal:** Build an OOP mindset + React component thinking

# 🎯 Day 1 Outcome

আজকের শেষে তুমি পারবা:

- OOP দিয়ে clean class design
- constructor use
- access modifiers বুঝতে
- Methods in classes
- object-oriented mini architecture বানাতে
- React JSX syntax
- reusable component
- props basics
- component mindset

---

## Part 1: PHP OOP Deep Dive (3 Hours)

### Topic 1: Class & Object

In PHP, a **class** is a blueprint, and an **object** is a real instance created from that blueprint.

```php
<?php

class User
{
    public $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

// Create an object (instance)
$user = new User();
$user->setName('Nirjhor');
echo $user->getName(); // Output: Nirjhor
```

#### Key Concepts:

| Term | Definition |
|------|------------|
| **Class** | A blueprint/template that defines properties and methods |
| **Object** | A real instance of a class, created with `new` keyword |
| **$this** | Reference to the current object instance |
| **new** | Keyword to create a new object |

---

### Topic 2: Access Modifiers

Access modifiers control where properties and methods can be accessed.

```php
<?php

class BankAccount
{
    public $accountName;    // Accessible everywhere
    protected $balance;     // Accessible in class & subclasses
    private $accountNumber; // Accessible only in this class

    public function deposit($amount)
    {
        $this->balance += $amount;
    }

    private function formatAccountNumber()
    {
        return str_pad($this->accountNumber, 8, '0', STR_PAD_LEFT);
    }
}

$account = new BankAccount();
$account->accountName = 'John Doe';
$account->deposit(1000);
// $account->balance // Error! Protected
// $account->accountNumber // Error! Private
```

#### Access Modifier Summary:

| Modifier | Class | Subclass | Outside |
|----------|-------|----------|---------|
| `public` | ✓ | ✓ | ✓ |
| `protected` | ✓ | ✓ | ✗ |
| `private` | ✓ | ✗ | ✗ |

---

### Topic 3: Constructor

A **constructor** is a special method that runs automatically when an object is created.

```php
<?php

class User
{
    public $name;
    public $email;

    // Constructor - runs when new User() is called
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function introduce()
    {
        return "Hi, I'm {$this->name} and my email is {$this->email}";
    }
}

$user = new User('Nirjhor', 'nirjhor@example.com');
echo $user->introduce();
// Output: Hi, I'm Nirjhor and my email is nirjhor@example.com
```

---

### Topic 4: Encapsulation Mindset

**Encapsulation** is the practice of controlling access to data by wrapping it in methods rather than exposing it directly. This protects your data and gives you control over how it's modified.

```php
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
```

**Why Encapsulation Matters:**
- Prevents invalid data modification
- Gives you control over how data changes
- Makes code easier to maintain
- **This pattern is heavily used in Laravel models and services**

---

### Practice Exercise: Build a Payment Class System

Let's build a professional Payment class to practice encapsulation:

```php
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

print_r($payment->getSummary());
// Output: Array ( [transaction_id] => TXN_abc123, [customer] => Nirjhor, [amount] => 5000, [currency] => BDT )
```

---

### Topic 5: Methods in Classes

```php
<?php

class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function subtract($a, $b)
    {
        return $a - $b;
    }

    public function multiply($a, $b)
    {
        return $a * $b;
    }

    public function divide($a, $b)
    {
        if ($b == 0) {
            return "Cannot divide by zero";
        }
        return $a / $b;
    }
}

$calc = new Calculator();
echo $calc->add(10, 5);        // 15
echo $calc->multiply(4, 5);    // 20
```

---

### Topic 6: Inheritance

Inheritance allows a class to inherit properties and methods from another class.

```php
<?php

class Animal
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function speak()
    {
        return "Some sound";
    }
}

class Dog extends Animal
{
    public function speak()
    {
        return $this->name . " says Woof!";
    }
}

class Cat extends Animal
{
    public function speak()
    {
        return $this->name . " says Meow!";
    }
}

$dog = new Dog('Buddy');
$cat = new Cat('Whiskers');

echo $dog->speak(); // Buddy says Woof!
echo $cat->speak(); // Whiskers says Meow!
```

---

### Topic 6: Static Methods and Properties

Static members belong to the class itself, not to any object instance.

```php
<?php

class Configuration
{
    public static $appName = 'MyApp';
    public static $version = '1.0.0';

    public static function getAppInfo()
    {
        return self::$appName . ' v' . self::$version;
    }
}

// Access without creating object
echo Configuration::$appName;           // MyApp
echo Configuration::getAppInfo();        // MyApp v1.0.0
```

---

### Practice Exercise 1

Create a PHP class called `Product` with:
- Properties: `name`, `price`, `quantity`
- Constructor to initialize all properties
- Method `getTotalPrice()` that returns `price * quantity`
- Method `displayInfo()` that shows product details

```php
<?php

class Product
{
    public $name;
    public $price;
    public $quantity;

    public function __construct($name, $price, $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getTotalPrice()
    {
        return $this->price * $this->quantity;
    }

    public function displayInfo()
    {
        return "Product: {$this->name}\nPrice: \${$this->price}\nQuantity: {$this->quantity}\nTotal: \$" . $this->getTotalPrice();
    }
}

$laptop = new Product('Laptop', 999, 2);
echo $laptop->displayInfo();
```







---

## Part 2: React Fundamentals (1 Hour)

### Topic 1: What is JSX?

JSX is a syntax extension that lets you write HTML-like code in JavaScript.

```jsx
// JSX looks like HTML but it's JavaScript
const element = <h1>Hello, World!</h1>;
```

**Key Difference:** In HTML you use `class`, in JSX you use `className`

```jsx
// Wrong
<div class="container">Hello</div>

// Correct
<div className="container">Hello</div>
```

---

### Topic 2: Creating Your First Component

A React component is a reusable piece of UI.

```jsx
// Functional Component
function Welcome() {
    return <h1>Hello, Welcome!</h1>;
}

// Arrow Function Component
const Welcome = () => {
    return <h1>Hello, Welcome!</h1>;
};

// Using the component
function App() {
    return (
        <div>
            <Welcome />
            <Welcome />
            <Welcome />
        </div>
    );
}
```

---

### Topic 3: Props - Passing Data to Components

**Props** (short for properties) are how you pass data from parent to child components.

```jsx
// Component that accepts props
function Greeting(props) {
    return <h1>Hello, {props.name}!</h1>;
}

// Using the component with props
function App() {
    return (
        <div>
            <Greeting name="Nirjhor" />
            <Greeting name="React" />
            <Greeting name="World" />
        </div>
    );
}
```

---

### Topic 4: Destructuring Props

Cleaner way to access props:

```jsx
// Without destructuring
function Greeting(props) {
    return <h1>Hello, {props.name}!</h1>;
}

// With destructuring
function Greeting({ name, age }) {
    return <h1>Hello, {name}! You are {age} years old.</h1>;
}

// Using
<Greeting name="Nirjhor" age={25} />
```

---

### Topic 5: Default Props

Set default values when props are not provided:

```jsx
function Greeting({ name = 'Guest', age = 18 }) {
    return <h1>Hello, {name}! Age: {age}</h1>;
}

// Both work:
// <Greeting /> → Hello, Guest! Age: 18
// <Greeting name="Nirjhor" /> → Hello, Nirjhor! Age: 18
```

---

### Practice Exercise 2

Create a React component called `ProductCard` that displays:
- Product name
- Product price
- A "Buy Now" button

```jsx
function ProductCard({ name, price }) {
    return (
        <div className="product-card">
            <h2>{name}</h2>
            <p>Price: ${price}</p>
            <button>Buy Now</button>
        </div>
    );
}

// Usage
<ProductCard name="Laptop" price={999} />
<ProductCard name="Phone" price={699} />
```

---

## Summary - What You Learned Today

### PHP OOP:
- ✅ Class & Object - Blueprint vs Instance
- ✅ Access Modifiers - public, protected, private
- ✅ Constructor - auto-run on object creation
- ✅ Methods - actions objects can perform
- ✅ Inheritance - child classes extend parents
- ✅ Static methods - class-level methods

### React:
- ✅ JSX - HTML in JavaScript
- ✅ Components - reusable UI pieces
- ✅ Props - passing data to components
- ✅ Destructuring - cleaner prop access

---

## How to Run Your React Code

### Step 1: Create a React Project

Open your terminal and run:

```bash
npx create-react-app my-react-app
cd my-react-app
npm start
```

This will create a new React app and start the development server at `http://localhost:3000`.

### Step 2: Alternative - Use Vite (Faster)

```bash
npm create vite@latest my-react-app -- --template react
cd my-react-app
npm install
npm run dev
```

### Step 3: Where to Write Your Code?

1. Open `src/App.js` (or `src/App.jsx`)
2. Replace the content with your component code
3. Save and see changes automatically

Example `src/App.js`:

```jsx
function App() {
  return (
    <div>
      <Welcome />
      <Welcome />
      <Welcome />
    </div>
  );
}

function Welcome() {
  return <h1>Hello, Welcome!</h1>;
}

export default App;
```

### Step 4: Run PHP Code

Create a file like `test.php` and run:

```bash
php test.php
```

---

## What's Next?

Tomorrow we'll dive deeper into:
- PHP: Interfaces, Traits, and Advanced OOP
- React: State management and Event handling

Keep practicing! The more you code, the better you get. 💪
