# Interview Q&A - Day 3

## PHP/Laravel Questions

### What is Abstraction?

**Definition:**
> Abstraction means hiding unnecessary implementation details and only exposing the essential functionality to the user. It helps create a clean contract between different layers of an application.

**Real Life Example:**
ATM machine - you only insert card, enter PIN, and withdraw. You don't know about the complex operations happening inside like database queries, balance checks, logging, and hardware communication.

**Code Example:**
```php
abstract class Payment {
    abstract public function pay($amount);
}

class BkashPayment extends Payment {
    public function pay($amount) {
        return "Paid {$amount} via Bkash";
    }
}
```

**Laravel Use Case:**
Laravel's Cache system uses abstraction - you use `Cache::put()` but the actual implementation (file, redis, database) is hidden from you.

---

### What is an Interface?

**Definition:**
> An interface defines a contract that multiple classes must follow. It specifies what methods a class must have, but not how they are implemented.

**Real Life Example:**
Delivery company riders - all must follow rules: pickup() and deliver(). Whether they use bike, truck, or drone is their choice, but they must follow the same contract.

**Code Example:**
```php
interface NotificationInterface {
    public function send($message);
}

class EmailNotification implements NotificationInterface {
    public function send($message) {
        return "Email: {$message}";
    }
}
```

---

### Interface vs Abstract Class - What is the difference?

| Aspect | Interface | Abstract Class |
|--------|-----------|---------------|
| Methods | Only declarations (no implementation) | Can have implementation |
| Properties | Not allowed | Allowed |
| Keyword | `implements` | `extends` |
| Multiple | Can implement multiple interfaces | Can extend only one class |
| Use Case | Pure contract | Contract + shared logic |

**When to use Interface:**
- When you want pure contract (what methods, not how)
- When multiple unrelated classes need same behavior
- When you need multiple inheritance

**When to use Abstract:**
- When you need shared logic among children
- When some methods are implemented, some not
- When single inheritance is enough

---

### Why use Interface in Laravel?

**Answer:**
1. **Flexibility** - Easy to swap implementations (e.g., switch cache from file to redis)
2. **Testability** - Easy to mock in unit tests
3. **Loose Coupling** - Code depends on abstraction, not concrete implementation
4. **Multiple Implementations** - Same interface, different behavior

**Laravel Examples:**
- `Cache::store('redis')` - uses same interface as file, database
- `Queue::connection('redis')` - uses same interface as sync, database
- `Notification::send()` - works with email, SMS, slack channels
- Repository Pattern in Service Layer

---

### What is Contract-based Design?

**Definition:**
> Contract-based design means defining clear interfaces (contracts) that different implementations must follow. This ensures different parts of your application can work together without knowing implementation details.

**Benefits:**
- Easy to change implementation
- Better testing
- Clean architecture
- Loose coupling

**Laravel Example:**
```php
interface UserRepositoryInterface {
    public function find($id);
    public function create(array $data);
}

// Implementation can be DB, Cache, or API
class DbUserRepository implements UserRepositoryInterface { }
```

---

### Can an interface have properties?

**Answer:**
No, interfaces cannot have properties. They can only declare methods. Abstract classes can have properties with actual values.

```php
// Wrong - Interface cannot have properties
interface Wrong {
    public $name;  // Error!
}

// Correct - Abstract class can have properties
abstract class Correct {
    public $name = "Nirjhor";  // OK!
}
```

---

### Can a class implement multiple interfaces?

**Answer:**
Yes! PHP allows a class to implement multiple interfaces.

```php
interface PaymentInterface {
    public function pay($amount);
}

interface RefundInterface {
    public function refund($amount);
}

class PaymentService implements PaymentInterface, RefundInterface {
    public function pay($amount) { /* ... */ }
    public function refund($amount) { /* ... */ }
}
```

---

### What is the difference between implements and extends?

| Keyword | Used With | Meaning |
|---------|-----------|---------|
| `extends` | Class | Inherit from parent class |
| `implements` | Interface | Follow contract |

```php
class Admin extends User { }  // Inherits from User class
class Bkash implements PaymentGateway { }  // Implements PaymentGateway interface
```

---

## React Questions

### What is State in React?

**Definition:**
> State is data that changes over time and controls dynamic UI updates. When state changes, React re-renders the component to reflect the new data.

**Examples:**
- Counter value (increases on click)
- Form input values (changes on typing)
- Modal open/close status
- API response data
- User authentication status

---

### Why use useState?

**Answer:**
`useState` is a React Hook that:
1. Allows components to have local state
2. Triggers re-render when state changes
3. Provides a way to update UI dynamically
4. Keeps UI in sync with data

**Code Example:**
```jsx
const [count, setCount] = useState(0);
```

`count` = current value
`setCount` = function to update value
`0` = initial value

---

### Props vs State - What is the difference?

| Aspect | Props | State |
|--------|-------|-------|
| Definition | Data passed from parent | Data managed internally |
| Who controls | Parent component | Component itself |
| Changes | Passed from outside | Managed by component |
| Triggers render | When parent passes new props | When setState is called |
| Can modify | No (read-only) | Yes (via setter) |

**Simple Analogy:**
- **Props** = Arguments passed to a function
- **State** = Local variables inside a function

---

### How does UI re-render when state changes?

**Process:**
1. State changes via `setState` or state setter
2. React marks component as "dirty"
3. React calls the component function again
4. React compares new output with previous (Virtual DOM diff)
5. Only changed parts are updated in real DOM

**Key Point:**
State change → Re-render → UI Update

---

### Can you have multiple state variables?

**Answer:**
Yes! You can have multiple `useState` calls in one component.

```jsx
function UserForm() {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [age, setAge] = useState(0);
    
    return (
        // ...
    );
}
```

---

### What happens when you update state asynchronously?

**Answer:**
State updates in React are asynchronous. When you call `setState`, React doesn't update immediately - it schedules the update for the next render.

```jsx
const [count, setCount] = useState(0);

// This won't print the new value immediately
setCount(count + 1);
console.log(count);  // Still prints old value!
```

To fix, use the callback form:
```jsx
setCount(prevCount => prevCount + 1);
```

---

### How to update state based on previous state?

**Answer:**
Use the callback function form of the state setter:

```jsx
// Wrong - may use stale state
setCount(count + 1);

// Correct - always uses latest state
setCount(prevCount => prevCount + 1);
```

---

### What is the initial value of useState?

**Answer:**
The initial value you pass to `useState()` is used only on the first render. After that, React uses the stored state value.

```jsx
const [count, setCount] = useState(0);
// First render: count = 0
// After setCount(5): count = 5
// Next render: count = 5 (not 0!)
```

---

### Can you use state in child components?

**Answer:**
Yes, but you need to pass it as props from parent:

```jsx
function Parent() {
    const [count, setCount] = useState(0);
    return <Child count={count} />;
}

function Child({ count }) {
    return <p>Count: {count}</p>;
}
```

State lives in the component that renders it. Child components receive it as props.

---

## Interview Speaking Tips

### Formula for Better Answers

Don't just give definitions. Use this formula:

```
Definition → Real-life example → Code use case → Laravel/React real use case
```

**Example (Interface):**

> "An interface is a contract. For example, payment gateways like Bkash and Card can follow the same pay() method contract. Laravel uses this in cache and queue drivers - whether you use redis or file cache, the interface is the same."

This style impresses interviewers because it shows:
1. You understand the concept
2. You can give real examples
3. You know practical applications

---

## Common Follow-up Questions

### Q: Can we use abstract class instead of interface?
**A:** Yes, but interface is better when you only need contract without shared logic.

### Q: How does React know when to re-render?
**A:** When state changes via setter function, React re-renders the component.

### Q: What is the difference between setState and useState?
**A:** useState is the hook that gives you state and setter. setState is class-based (older React).

### Q: Can we share state between components?
**A:** Yes, by lifting state up to a common parent or using Context API.

---

## Recruiter Tips

### What interviewers look for:

1. **Understanding over memorization** - Know why, not just what
2. **Real-world examples** - Can you apply concepts?
3. **Laravel knowledge** - How frameworks use these patterns
4. **Problem-solving** - How you approach issues
5. **Clean code** - Follow conventions
6. **Communication** - Can you explain clearly?

### Red flags:
- Just memorized definitions without understanding
- Can't give real examples
- Don't know how Laravel uses OOP
- Poor code organization
