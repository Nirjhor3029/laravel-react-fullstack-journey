# Laravel + React Fullstack Journey - Day 4

## Welcome to Day 4! 🚀

Today we're learning advanced PHP OOP concepts and React event handling.

### Today's Roadmap

| Technology | Time | Focus |
|------------|------|-------|
| Laravel/PHP | 3 hours | Traits, Static Methods, Magic Methods |
| React | 1 hour | Event Handling |

**Goal:** Master traits for code reuse, static for shared data, magic methods for flexibility, and React events.

---

## 🎯 Day 4 Outcome

আজকের শেষে তুমি পারবা:

- Traits দিয়ে reusable methods share করা
- Static methods/properties বুঝতে পারা
- Magic methods master করা
- React event handling + synthetic events

---

## 🐘 Part 1: Traits

```php
<?php

trait Logger
{
    public function log($message)
    {
        echo "Log: $message";
    }
}

class User
{
    use Logger;
}

$user = new User();
$user->log("Hello");
```

#### Laravel traits: SoftDeletes, Notifiable, HasFactory

---

## 🐘 Part 2: Static Methods

```php
<?php

class Config
{
    public static $appName = "FullstackApp";

    public static function getAppName()
    {
        return self::$appName;
    }
}

echo Config::$appName;
echo Config::getAppName();
```

---

## 🐘 Part 3: Magic Methods

```php
<?php

class User
{
    private $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
}

$user = new User();
$user->name = "Nirjhor";
echo $user->name;
```

---

## ⚛️ Part 4: React Events

```jsx
import { useState } from "react";

function Counter() {
    const [count, setCount] = useState(0);

    function handleClick() {
        setCount(count + 1);
    }

    return <button onClick={handleClick}>Count: {count}</button>;
}
```

```jsx
function Input() {
    const [name, setName] = useState("");

    return (
        <input
            value={name}
            onChange={(e) => setName(e.target.value)}
            placeholder="Enter name"
        />
    );
}
```

---

## Summary

### PHP OOP:
- ✅ Traits - horizontal code reuse
- ✅ Static - class-level methods/data
- ✅ Magic Methods - dynamic properties

### React:
- ✅ Event Handling - onClick, onChange
- ✅ Synthetic Events

---

## How to Run

### PHP:
```bash
php php-traits/Logger.php
```

### React:
```bash
npx create-react-app my-app
# or
npm create vite@latest my-app -- --template react
```

---

## What's Next? (Day 5)

Tomorrow:
- Laravel Service Container + Dependency Injection
- React Props Drill

Keep practicing! 💪
