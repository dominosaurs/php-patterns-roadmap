# 🐘 02-refactored-procedural

This pattern represents the first step towards clean code by applying the **DRY (Don't Repeat Yourself)** principle. We move from "spaghetti code" to a more organized structure by extracting repetitive logic into reusable functions.

## Characteristics

- **Centralized Helpers**: Introduction of `_includes/functions.php` to house logic used across multiple pages.
- **Database Abstraction (Level 1)**: Basic wrapper functions like `db_get_all()` and `db_query()` eliminate PDO boilerplate (`prepare`, `execute`, `fetchAll`).
- **Short-hand Escaping**: A dedicated `e()` function replaces the verbose `htmlspecialchars()`, making views cleaner and reducing the risk of XSS by making security easy to write.
- **Standardized Redirects**: A `redirect()` helper standardizes page transitions and ensures the `exit` command is never forgotten.
- **UI State Helper**: Introduction of `is_active($path)` to centralize the logic for highlighting active navigation links.

## The Evolution: What Changed?

| Feature | Pattern 01 (Basic) | Pattern 02 (Refactored) |
| :--- | :--- | :--- |
| **Escaping** | `htmlspecialchars($val, ENT_QUOTES, 'UTF-8')` | `e($val)` |
| **Database** | Manual `prepare` / `execute` every time. | Single function call: `db_get_all($sql)`. |
| **Redirection** | `header('Location: ...'); exit;` | `redirect('...');` |
| **Active Link** | Manual `strpos` checks in `header.php`. | Single helper call: `is_active('path')`. |
| **Logic Reuse** | Copy-pasting logic blocks. | Calling shared functions. |

## Observations for Learning

- **Readability**: Compare **[index.php in 01](../01-basic-procedural/index.php)** vs **[index.php in 02](./index.php)**. Notice how much easier it is to see the "Business Logic" now that the database connection boilerplate is hidden inside functions.
- **Security**: Because the `e()` function is so short, you are more likely to use it consistently, making the application safer by default.
- **UI Logic Centralization**: Look at `header.php`. Instead of calculating which link is "current" using messy string operations inside the HTML, we now use `is_active()`. This keeps our templates focused on presentation.
- **Single Point of Change**: If you want to change how all database errors are logged, you only need to modify the `db_query` function in `functions.php`, rather than updating every single file.

## What's still missing?

- **Global Dependency**: Our functions still rely on the `global $pdo` variable, which makes testing difficult and creates hidden dependencies.
- **Flat Structure**: We still have a "one file per URL" structure, which will become unmanageable as the app grows.
- **Mixed Concerns**: While the *logic* is cleaner, it's still mixed directly with the *HTML presentation* in the same files.

---
Previous Pattern: **[01-basic-procedural](../01-basic-procedural/)**  
Next Pattern: **[03-front-controller-routing](../03-front-controller-routing/)**
