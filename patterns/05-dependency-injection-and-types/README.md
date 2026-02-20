# 🐘 05-dependency-injection-and-types

This pattern introduces industry-standard software engineering practices: **Strict Typing**, **Dependency Injection (DI)**, and **Constructor Property Promotion**. We maintain a convenient Static API while shifting to a robust, object-oriented core.

## 🎯 Why is this important?

Previous patterns relied on global state and loose data handling. Pattern 05 establishes a solid foundation for growth:

1. **Strict Types**: Every file uses `declare(strict_types=1);`. This forces PHP to validate data types strictly, catching bugs (like passing `null` where a `string` is required) before they reach production.
2. **Input Injection**: The `Request` class no longer reaches for `$_GET` or `$_POST` globally. Instead, these arrays are **injected** into the object. This makes our code "agnostic" to the environment and ready for automated testing.
3. **Constructor Property Promotion**: We use PHP 8.0+ syntax to define and initialize properties directly in the constructor, significantly reducing repetitive boilerplate code.
4. **Encapsulated State**: Core services like `Database`, `View`, and `Http` are now true objects managed behind a clean static interface. This protects the internal state from external interference.

## ⚡ Code Transformations

See how the implementation has matured:

### 1. Dependency Injection for Input

We've decoupled our classes from the global environment.

```diff
- // Pattern 04: Directly accessing superglobals
- public static function post($key) {
-     return $_POST[$key] ?? null;
- }
+ // Pattern 05: Data is injected during bootstrap
+ public function __construct(private array $post) {}
+ 
+ public static function post(string $key) {
+     return self::getInstance()->post[$key] ?? null;
+ }
```

### 2. Constructor Property Promotion (PHP 8.0+)

 We reduce boilerplate by defining dependencies and properties in a single line.

```diff
- private View $view;
- public function __construct(View $view) {
-     $this->view = $view;
- }
+ public function __construct(
+     private View $view
+ ) {}
```

### 3. Strict Type Enforcement

Methods now have clear "contracts" for what they accept and what they return.

```diff
+ declare(strict_types=1);
+ 
+ public static function query(string $sql, array $params = []): PDOStatement
```

## Characteristics

- **Strict Mode**: Mandatory `declare(strict_types=1);` in all core and logic files.
- **Isolated Input**: `Request` object owns its data, passed from `index.php`.
- **Static Proxy API**: External logic uses easy static calls (`Database::getAll()`), while internal logic uses strictly typed objects.
- **Bootstrapping**: The Front Controller (`index.php`) acts as the "wiring" layer where dependencies are connected.

## The Evolution: What Changed?

| Feature | Pattern 04 (Infrastructure) | Pattern 05 (DI & Types) |
| :--- | :--- | :--- |
| **Environment** | Global Superglobals | **Injected Arrays** |
| **Typing** | Loose/Implicit | **Strict & Explicit** |
| **DI Strategy** | Static Reliance | **Constructor Promotion** |
| **Internal State** | Shared/Global | **Encapsulated Objects** |

## Observations for Learning

- **Testability**: Because `Request` receives data as an array, you could theoretically run your application logic from a terminal or a test script by just passing a "fake" array of data.
- **Fail Fast**: Try changing a parameter type in a logic file. PHP will now give you a clear `TypeError` instead of a mysterious database error or a broken UI.
- **Modern Syntax**: Look at `src/Core/Http.php`. Notice how clean the class is despite having dependencies. Promotion makes modern PHP feel lightweight.

## What's still missing?

- **Proper MVC**: Our logic is still split into many procedural scripts. We need to group them into **Controller Classes**.
- **Data Mapping**: We are still writing raw SQL strings everywhere. We need **Models** to represent our data as objects.

---
Previous Pattern: **[04-modern-infrastructure](../04-modern-infrastructure/)**  
Next Pattern: **[06-mvc-and-active-record](../06-mvc-and-active-record/)**
