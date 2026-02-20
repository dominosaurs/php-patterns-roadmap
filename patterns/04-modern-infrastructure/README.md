# 🐘 04-modern-infrastructure

This pattern introduces an **Infrastructure Layer** by combining four essential concepts: PSR-4 Autoloading, the Singleton Pattern, Middleware, and Request Abstraction.

## 🎯 Why is this important?

As an application grows, managing files and resources manually becomes difficult. This pattern establishes a structured foundation:

1. **Standard Autoloading**: All classes are loaded automatically based on their namespace via the root `composer.json`. This leverages the autoloader you initialized during the [Getting Started](../../README.md#getting-started) phase.
2. **Efficient Resource Management (Singleton)**: The `Database` class now manages its own single instance. This ensures resource efficiency—no matter how many times you call the database, only **one** connection is ever created.
3. **Global Request Interception (Middleware)**: We introduce an execution chain in `index.php` that can "intercept" requests before they reach your logic. This is for global tasks like logging, security headers, or maintenance checks.
4. **Request Abstraction**: We no longer access `$_GET` or `$_POST` directly. By using the `Request` class, we make our logic cleaner, safer, and ready for future advanced features.
5. **Standardized Layouts**: We've automated the inclusion of common UI elements (Header/Footer). This ensures a consistent look across all pages without repetitive `require` calls in every view.

## ⚡ Code Transformations

Compare the implementation standards between Pattern 03 and Pattern 04:

### 1. Database Access

```diff
- global $pdo;
- $stmt = $pdo->prepare($sql);
- $stmt->execute($params);
+ use App\P04\Core\Database;
+ $results = Database::getAll($sql, $params);
```

### 2. Request Handling

```diff
- if ($_SERVER['REQUEST_METHOD'] === 'POST') {
-     $name = $_POST['name'];
- }
+ use App\P04\Core\Request;
+ if (Request::isPost()) {
+     $name = Request::post('name');
+ }
```

### 3. View Rendering & Layouts

```diff
- $title = 'Page Title';
- require '_includes/header.php';
- require 'views/todo/index.php';
- require '_includes/footer.php';
+ use App\P04\Core\View;
+ View::render('todo/index', 'Page Title', ['todos' => $todos]);
```

### 4. UI State Management

```diff
- $current_route = trim($route_path, '/') ?: 'todo/index';
- class="<?= strpos($current_route, 'todo/') === 0 ? 'current' : '' ?>"
+ use App\P04\Core\View;
+ class="<?= View::isActiveRoute('todo/') ? 'current' : '' ?>"
```

## Characteristics

- **Centralized Autoloading**: Uses the global autoloader for efficient class discovery.
- **Pattern Namespacing**: Uses the `App\P04\` namespace to isolate its core components.
- **Request Helper**: `App\P04\Core\Request` handles all input and route detection.
- **Autonomous Singleton**: `Database::getInstance()` manages the PDO connection automatically.
- **Automatic Layouts**: `View::render()` manages the page assembly (Header + Content + Footer).

## The Evolution: What Changed?

| Feature | Pattern 03 (Routing) | Pattern 04 (Infrastructure) |
| :--- | :--- | :--- |
| **Class Discovery** | Manual `require` | **Automated** (PSR-4) |
| **Database** | Global variable | **Singleton Pattern** |
| **Input Handling** | Direct Superglobals | **Request Abstraction** |
| **Active Link** | Manual string checks | **Route Helper** (`isActiveRoute`) |
| **UI Layouts** | Manual `require` in views | **Automated** via `View::render()` |

## Observations for Learning

- **Single Entry Point Orchestration**: Look at `index.php`. It is no longer just a router; it's an orchestrator that runs middlewares, determines the route via the `Request` class, and executes the logic.
- **Encapsulated State**: Notice how logic files like `logic/todo/index.php` are now "agnostic" about the database connection or the file system. They simply request data and trigger a render.
- **Zero-Boilerplate Views**: Open any file in `views/`. They contain **purely** the content of the page. All "plumbing" (header, footer, helper imports) is handled by the core infrastructure.

> [!IMPORTANT]
> **Known Issue: Direct File Access**  
> Sub-files can still be accessed directly via their URL path if the server is not configured to restrict them. While modern frameworks solve this using a separate `/public` folder, we are keeping all files visible for educational clarity. Entry point protection is considered **out of scope** for this project.

## What's still missing?

- **Proper MVC**: Our logic is still split into many procedural files. We need to group them into **Controller Classes**.
- **Dependency Injection**: We are still relying on static methods, which makes classes tightly coupled and harder to test.

---
Previous Pattern: **[03-front-controller-routing](../03-front-controller-routing/)**  
Next Pattern: **[05-dependency-injection-and-types](../05-dependency-injection-and-types/)**
