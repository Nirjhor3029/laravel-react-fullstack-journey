# Day 2 Interview Q&A - Inheritance & Polymorphism

## 🐘 PHP - Inheritance & Polymorphism

### Q1: What is inheritance in PHP?

**Answer:** Inheritance allows a class (child/subclass) to inherit properties and methods from another class (parent/superclass). This promotes code reuse and establishes a parent-child relationship.

```php
class User { ... }
class Admin extends User { ... }  // Admin inherits from User
```

---

### Q2: Why do we use inheritance?

**Answer:** 
- Code reusability - don't repeat yourself
- Establish clear hierarchy
- Laravel uses it everywhere (Controller extends BaseController, Model extends Eloquent)
- Enables polymorphism

---

### Q3: What is method overriding?

**Answer:** Method overriding is when a child class provides a different implementation of a method that already exists in the parent class. The method signature (name and parameters) must be the same.

```php
class User {
    public function role() { return "User"; }
}

class Admin extends User {
    public function role() { return "Admin"; }  // Override
}
```

---

### Q4: When do we use `parent::` keyword?

**Answer:** We use `parent::` when we want to:
- Call parent class method from child class
- Extend parent method behavior instead of completely replacing it

```php
class Admin extends User {
    public function greet() {
        return parent::greet() . ", Admin";  // Keep parent logic + add more
    }
}
```

---

### Q5: What is polymorphism?

**Answer:** Polymorphism means "many forms" - the ability to treat objects of different classes through the same interface. Same method call produces different results based on the actual object type.

```php
$payments = [new BkashPayment(), new CardPayment()];
foreach ($payments as $payment) {
    echo $payment->pay();  // Same method, different output
}
```

---

### Q6: Real-world example of polymorphism in Laravel?

**Answer:** Laravel's Notification system - you can send notifications via Email, SMS, Slack, etc. All have a `send()` method but different implementations:

```php
// User can have multiple notification channels
$user->notify(new EmailNotification());
$user->notify(new SMSNotification());
$user->notify(new SlackNotification());
```

---

### Q7: What is the difference between `extends` and `implements`?

**Answer:**
- `extends` - for class inheritance (one class inherits from another)
- `implements` - for interfaces (class contracts to implement methods)

```php
class Admin extends User { }        // Inheritance
class Admin implements AdminInterface { }  // Interface
```

---

### Q8: What is `protected` access modifier?

**Answer:** `protected` allows access within the class AND its child classes, but NOT from outside.

```php
class Animal {
    protected $name = 'Animal';
}

class Dog extends Animal {
    public function show() {
        return $this->name;  // ✓ Accessible here
    }
}

$dog = new Dog();
echo $dog->name;  // ✗ Error - not accessible outside
```

---

### Q9: How does constructor inheritance work?

**Answer:** Child class can call parent constructor using `parent::__construct()`. If child doesn't define a constructor, parent constructor is called automatically.

```php
class User {
    public function __construct($name) {
        $this->name = $name;
    }
}

class Admin extends User {
    public function __construct($name, $level) {
        parent::__construct($name);  // Call parent's constructor
        $this->level = $level;
    }
}
```

---

### Q10: Laravel-specific inheritance questions:

**Q: How does Laravel's Controller use inheritance?**

```php
// Laravel's Foundation
class Controller extends BaseController {}

// Your controller
class UserController extends Controller {}

// You automatically get all BaseController methods!
```

**Q: How does Laravel's Model use inheritance?**

```php
class User extends Model {
    // Now you have access to:
    // - all() - get all records
    // - find() - find by ID
    // - where() - query builder
    // - relationships
}
```

---

## ⚛️ React - Props Deep Dive

### Q1: What are props in React?

**Answer:** Props (properties) are how you pass data from parent component to child component. They make components reusable and dynamic.

```jsx
function UserCard({ name, role }) {
    return <h2>{name} - {role}</h2>;
}

<UserCard name="Nirjhor" role="Admin" />
```

---

### Q2: Why are props important?

**Answer:**
- Makes components reusable
- One component, different data = multiple use cases
- Enables dynamic UI
- Follows unidirectional data flow

---

### Q3: What is the difference between hardcoded and dynamic props?

**Answer:**

```jsx
// Hardcoded - always same
function Card() {
    return <div>Hello</div>;
}

// Dynamic - changes based on props
function Card({ title, value }) {
    return <div>{title}: {value}</div>;
}

<Card title="Users" value={100} />
<Card title="Jobs" value={500} />
```

---

### Q4: How do you use default props?

**Answer:**

```jsx
function Button({ text = 'Click', type = 'primary' }) {
    return <button className={`btn-${type}`}>{text}</button>;
}

// Now:
// <Button /> → Click (primary)
// <Button text="Submit" /> → Submit (primary)
// <Button text="Delete" type="danger" /> → Delete (danger)
```

---

### Q5: Can you pass functions as props?

**Answer:** Yes! This is common for handling events.

```jsx
function Button({ onClick, text }) {
    return <button onClick={onClick}>{text}</button>;
}

function App() {
    const handleClick = () => alert('Clicked!');
    
    return <Button onClick={handleClick} text="Click Me" />;
}
```

---

### Q6: How do you map array data to components?

**Answer:**

```jsx
function UserCard({ name, email }) {
    return <div>{name} - {email}</div>;
}

function App() {
    const users = [
        { name: 'Nirjhor', email: 'nirjhor@example.com' },
        { name: 'Sazzad', email: 'sazzad@example.com' }
    ];
    
    return (
        <div>
            {users.map((user, index) => (
                <UserCard key={index} name={user.name} email={user.email} />
            ))}
        </div>
    );
}
```

---

### Q7: Benefits of reusable components?

**Answer:**
- DRY (Don't Repeat Yourself)
- Easy to maintain
- Consistent UI
- Single source of truth
- Easier testing

---

### Q8: Props vs State?

**Answer:**
- **Props:** Passed from parent, read-only, for component communication
- **State:** Internal component data, mutable, for component's own data

---

## 🎯 Mentor-Level Thinking Questions

### Q1: How does inheritance relate to Laravel services?

**Answer:** Laravel services use inheritance for:
- Strategy Pattern: Different payment classes extend a base Payment class
- Notification Channels: Email/SMS/Push extend base Notification
- Repository Pattern: Custom repos extend base repository

### Q2: How does React props pattern relate to OOP?

**Answer:** 
- Component = Class
- Props = Constructor parameters
- Reusable component = Object instantiated with different data
- Same concept, different implementation!

### Q3: "One interface, many behaviors" - Explain

**Answer:**
```php
// Interface/Base: Notification
// Behaviors: Email, SMS, Push
// One send() method, different implementations

$notifications = [
    new EmailNotification(),
    new SMSNotification(),
    new PushNotification()
];
// All treated as Notification, behaves differently
```

This is the foundation of:
- Laravel's Notification system
- Payment gateways
- Storage drivers
- Authentication guards

---

## 💡 Quick Summary Table

| Concept | PHP | React |
|---------|-----|-------|
| Reuse | extends | props |
| Override | method overriding | - |
| Extend parent | parent:: | - |
| Multiple forms | Polymorphism | Same component, different props |
| Protected | protected | - |

---

## 🔥 Interview Pro Tips

1. **Always mention Laravel** when discussing inheritance
2. **Give real examples** - Payment, Notification, User roles
3. **Connect the dots** - PHP inheritance = React reusable components (same mindset!)
4. **Know the "why"** - Don't just know "what", know "why it's useful"

---

Remember: "One interface, many behaviors" - this single concept powers Laravel services, payment gateways, and React reusable components!

Keep practicing! 💪