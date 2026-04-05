# Interview Q&A - Day 1

## PHP / Laravel Questions

### Class আর object এর difference?

**Class** হলো একটি blueprint বা template যা properties এবং methods define করে। এটি শুধুমাত্র একটি plan।

**Object** হলো Class থেকে create করা একটি real instance। `new` keyword ব্যবহার করে তৈরি করা হয়।

```php
class User { ... } // Class - blueprint
$user = new User(); // Object - real instance
```

---

### Constructor কেন use হয়?

Constructor হলো একটি special method যা automatically run হয় যখন object create হয়। এটি দিয়ে:
- Object initialize করা যায়
- Default values set করা যায়
- Required data দেওয়া বাধ্যতামূলক করা যায়

```php
public function __construct($name, $email) {
    $this->name = $name;
    $this->email = $email;
}
```

---

### private vs protected?

**private:** শুধুমাত্র একই class থেকে access করা যায়। Subclasses বা outside থেকে access না।

**protected:** একই class এবং subclasses থেকে access করা যায়। কিন্তু outside থেকে access না।

| Access | Class | Subclass | Outside |
|--------|-------|----------|---------|
| private | ✓ | ✗ | ✗ |
| protected | ✓ | ✓ | ✗ |

---

### Encapsulation real example?

Encapsulation হলো data hide করা এবং শুধুমাত্র methods এর মাধ্যমে access দেওয়া। Real example - BankAccount:

```php
class BankAccount {
    private $balance = 0; // Data hidden

    public function deposit($amount) {
        if($amount > 0) {
            $this->balance += $amount;
        }
    }

    public function withdraw($amount) {
        if($amount <= $this->balance) {
            $this->balance -= $amount;
        }
    }
}
```

এখানে balance directly access করা যায় না, শুধুমাত্র deposit/withdraw method এর মাধ্যমে পরিবর্তন করা যায়।

---

### $this কী?

`$this` হলো current object instance এর reference। এটি দিয়ে object এর নিজের properties এবং methods access করা যায়।

```php
public function setName($name) {
    $this->name = $name; // Current object's property
}
```

---

### What is a Class in PHP?

A class is a blueprint that defines properties (variables) and methods (functions) for creating objects.

---

### What is an Object in PHP?

An object is an instance of a class, created using the `new` keyword.

---

### What are Access Modifiers in PHP?

Access modifiers define the visibility of properties and methods: `public`, `protected`, and `private`.

---

### What is Inheritance in PHP?

Inheritance allows a class (child) to inherit properties and methods from another class (parent).

---

### What are Static Methods in PHP?

Static methods belong to the class itself, not to any object. Called using `ClassName::method()`.

---

## React Questions

### JSX কী?

JSX হলো JavaScript এর একটি syntax extension যা HTML-like code লেখা JavaScript এর মধ্যে সম্ভব করে।

```jsx
const element = <h1>Hello World</h1>;
```

Note: HTML এ `class` ব্যবহার করলেও JSX এ `className` ব্যবহার করতে হয়।

---

### Component কেন reusable?

Component গুলো reusable কারণ:
- একই UI বারবার ব্যবহার করা যায়
- Props দিয়ে dynamic data pass করা যায়
- Code duplication কমায়
- Maintain করা সহজ

---

### Props vs hardcoded UI?

**Props:** Dynamic data দিয়ে component customize করা যায়, একই component বিভিন্ন data show করতে পারে।

**Hardcoded UI:** শুধুমাত্র একটি fixed content show করে, পরিবর্তন করতে code edit করতে হয়।

```jsx
// Props - Reusable
<ProductCard name="Laptop" price={999} />
<ProductCard name="Phone" price={699} />

// Hardcoded - Not reusable
<div>Laptop - $999</div>
```

---

### Why single parent element?

React এ প্রতিটি component must return single parent element। এর কারণ:
- Virtual DOM tree একটি single root node চায়
- Multiple elements return করলে error হয়
- Fragment ব্যব করে এড়ানো যায়: `<>...</>`

---

### What is a React Component?

A React component is a reusable piece of UI that can be a function or class.

---

### How do you pass data to a component?

Using **props** (properties). Props are passed like HTML attributes.

```jsx
<Greeting name="Nirjhor" age={25} />
```

---

### What is component destructuring?

Destructuring is a cleaner way to access props without using `props.` prefix.

```jsx
function Greeting({ name, age }) {
    return <h1>Hello, {name}!</h1>;
}
```

---

### What are Default Props?

Default props set fallback values when props are not provided.

```jsx
function Greeting({ name = 'Guest' }) { ... }
```

---

## Recruiter Tips

### What are interviewers looking for?

1. **Understanding over memorization** - Know why, not just what
2. **Real-world examples** - Can you apply concepts?
3. **Code clarity** - Clean, readable code
4. **Problem-solving** - How you approach issues
5. **Best practices** - Follow conventions
