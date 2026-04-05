# Day 3 - Quick Reference

## Topics Covered

### PHP/Laravel
- **Abstraction** - Hiding complexity, showing only essentials
- **Interface** - Contract that classes must follow
- **Abstract Class** - Contract + shared logic
- **Interface vs Abstract** - When to use which
- **Laravel Real Use** - Cache, Queue, Notifications, Repository Pattern

### React
- **State** - Dynamic UI data
- **useState** - Hook for managing state
- **Interactive Components** - Dynamic UI updates

## Quick Code Snippets

### PHP Interface
```php
interface PaymentGateway {
    public function pay($amount);
}

class BkashPayment implements PaymentGateway {
    public function pay($amount) {
        return "Paid {$amount} via Bkash";
    }
}
```

### React useState
```jsx
const [count, setCount] = useState(0);
setCount(count + 1);
```

## Interview Formula
> Definition → Real-life example → Code → Laravel/React use case

## What's Next?
- Day 4: Traits, Static Methods, Magic Methods (PHP)
- Day 4: Event Handling, Form Handling (React)

## Files Created
- `learning.md` - Full tutorial
- `interview-qa.md` - Interview questions
- `notes.md` - Your personal notes
- `readme.md` - This file
