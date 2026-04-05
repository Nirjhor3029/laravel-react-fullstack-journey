# Q&A While Learning PHP

---

## Table of Contents

1. [Why use `static::$config` instead of `self::$config` in trait?](#1-why-use-staticconfig-instead-of-selfconfig-in-trait)
2. [When to use data type declarations in PHP?](#2-when-to-use-data-type-declarations-in-php)
3. [Why use magic methods `__get` and `__set` instead of regular getter/setter?](#3-why-use-magic-methods-__get-and-__set-instead-of-regular-gettersetter)
4. [How does method chaining work with `__call`?](#4-how-does-method-chaining-work-with-__call)
5. [What is Late Static Binding?](#5-what-is-late-static-binding)

---

## 1. Why use `static::$config` instead of `self::$config` in trait?

### Short Answer

`static::$config` is used so that the class from which the method is called uses its own static property.

`self::$config` would treat the trait/method definition location as fixed.

### Code Example

```php
trait Config
{
    protected static array $config = [];

    public static function set($key, $value)
    {
        static::$config[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return static::$config[$key] ?? $default;
    }
}

class AppConfig
{
    use Config;
}

class DatabaseConfig
{
    use Config;
}

AppConfig::set('name', 'MyApp');
DatabaseConfig::set('host', 'localhost');

echo AppConfig::get('name');       // MyApp
echo DatabaseConfig::get('host');   // localhost
```

### Why `static` is Better

When calling:
- `AppConfig::set()` → AppConfig's context
- `DatabaseConfig::set()` → DatabaseConfig's context

`static::` respects the calling class.

### Example with Subclass

```php
class BaseConfig
{
    use Config;
}

class ChildConfig extends BaseConfig
{
    protected static array $config = [];
}

ChildConfig::set('theme', 'dark');
```

- `static::` → uses `ChildConfig::$config['theme'] = 'dark'` (correct)
- `self::` → uses `BaseConfig::$config['theme'] = 'dark'` (wrong)

### Easy Rule

- **self**: Current class fixed, compile time binding
- **static**: Who called the method, runtime binding (Late Static Binding)

### Laravel Connection

In Laravel model events:

```php
static::creating(function ($user) {
});
```

`static::` is used so child model call preserves child model context.

---

## 2. When to use data type declarations in PHP?

### Property - Best Practice (use type)

```php
public static string $appName = "FullstackApp";
public static string $env = "development";
public static bool $debug = true;
```

- PHP 7.4+ feature
- Best practice
- Error if wrong type assigned

### Method Return Type (always use when possible)

```php
public static function getAppName(): string
{
    return self::$appName;
}

public static function isDebug(): bool
{
    return self::$debug;
}
```

### Parameter Type (always use)

```php
public static function setEnv(string $env): void
{
    self::$env = $env;
}
```

### When NOT to Use Type

When same function accepts different types:

```php
public static function set($key, $value)
```

Here `$value` can be string/int/array/object - anything.

### Best Version

```php
class Config
{
    public static string $appName = "FullstackApp";
    public static string $env = "development";
    public static bool $debug = true;

    public static function getAppName(): string
    {
        return self::$appName;
    }

    public static function isDebug(): bool
    {
        return self::$debug;
    }
}
```

### Senior Developer Rule

- Use type where value is predictable
- Skip only when flexibility is intentionally required

---

## 3. Why use magic methods `__get` and `__set` instead of regular getter/setter?

### Regular Getter/Setter Way

```php
class User
{
    private string $name;
    private string $email;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

// Usage:
$user->setName("Nirjhor");
echo $user->getName();
```

- Explicit and strict
- But repetitive

### Magic Method Way

```php
class User
{
    private array $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
}

$user = new User();
$user->name = "Nirjhor";
$user->email = "nirjhor@example.com";

echo $user->name;   // Nirjhor
echo $user->email;  // nirjhor@example.com
```

- Short and readable
- Feels natural like JS object

### Main Advantage 1: Dynamic Fields

When user data comes from API/database with many fields:

```json
{
   "name": "Nirjhor",
   "email": "x@gmail.com",
   "phone": "123",
   "address": "Dhaka"
}
```

Without magic methods you'd need:
```php
getName()
getEmail()
getPhone()
getAddress()
```

But with magic methods:
```php
$user->phone
$user->address
```
Any new field works automatically.

### Main Advantage 2: Less Boilerplate

50 properties = 100 getter/setter methods needed.
Magic methods: just `__get()` and `__set()` handle everything.

### Main Advantage 3: ORM Style Syntax (Laravel)

In Laravel models you write:
```php
$user->name
$user->email
```

But the model class doesn't have `name` property defined! It works because internally `__get()` `__set()` read/write from DB attributes array.

### Main Advantage 4: Validation/Transformation

```php
public function __set($name, $value)
{
    if ($name === 'email') {
        $value = strtolower($value);
    }
    $this->data[$name] = $value;
}

$user->email = "ABC@MAIL.COM";
// Stored as: abc@mail.com
```

Laravel mutators use the same concept.

### Downside

- IDE autocomplete weak
- Type safety less
- Debug harder (hidden logic)

### When to Use Which

**Getter/Setter Better**: When properties are fixed (name, email, age)

**Magic Methods Best**: When fields are dynamic (ORM models, DTO from API, config objects, flexible schemas)

### Senior Dev Rule

- Fixed structure → getter/setter
- Dynamic structure → magic methods

---

## 4. How does method chaining work with `__call`?

### Code Example

```php
class User
{
    private array $methods = [];

    public function __call($name, $arguments)
    {
        $this->methods[$name] = $arguments;
        return $this;
    }

    public static function __callStatic($name, $arguments)
    {
        echo "Static call: $name\n";
    }
}

$user = new User();
$user->setName("Nirjhor")
    ->setEmail("nirjhor@example.com");

print_r($user);

User::customMethod();
User::anythingStatic();
```

### Step by Step Breakdown

**Step 1**: `setName()` method doesn't exist in class

PHP rule: when undefined instance method is called, `__call()` executes.

```php
$user->setName("Nirjhor");
```
internally becomes:
```php
$user->__call("setName", ["Nirjhor"]);
```

**Step 2**: Values stored

Inside `__call()`:
```php
$this->methods[$name] = $arguments;
```
becomes:
```php
$this->methods["setName"] = ["Nirjhor"];
```

**Step 3**: `return $this` - This is the chaining secret

Returns current object ($user), so first call result is still the same object.

**Step 4**: Next chain call

```php
->setEmail("nirjhor@example.com")
```

Again method doesn't exist → `__call()` called.

Final state:
```php
[
    "setName" => ["Nirjhor"],
    "setEmail" => ["nirjhor@example.com"]
]
```

### Chaining Rule

If method ends with `return $this`, chaining is possible:

```php
$obj->a()->b()->c();
```

### Real Laravel Example

This exact pattern is used in:

```php
User::where('id', 1)
    ->orderBy('name')
    ->first();
```

Each method returns object enabling the chain.

---

## 5. What is Late Static Binding?

### Definition

Late Static Binding resolves the calling class at runtime rather than compile time.

### Self vs Static

```php
class Base
{
    public static function who()
    {
        echo __CLASS__;  // Base
    }

    public static function test()
    {
        self::who();  // Always resolves to Base
        static::who(); // Resolves to the called class
    }
}

class Child extends Base {}

Child::test();
// self::who() → Base
// static::who() → Child
```

### Key Difference

- **self**: Binds to class where method is defined (compile time)
- **static**: Uses late static binding, resolves calling class at runtime

### Laravel Real Example

```php
class User extends Model
{
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($user) {
            // Uses User class, not Model
        });
    }
}
```

`static::` ensures child model context is preserved.