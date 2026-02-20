# 🐘 03-front-controller-routing

This pattern moves the application from multiple entry points to a single **Front Controller** (`index.php`). All requests now pass through one file, which centralizes shared logic and routing using **Pretty URLs**.

## 🎯 Why is this important?

In Patterns 01 and 02, your application had "multiple front doors" (e.g., `create.php`, `update.php`, `delete.php`). This created several problems that Pattern 03 solves:

1. **Centralized Bootstrapping**: Previously, every file had to manually include `pdo.php` and `functions.php`. If you added a new global tool (like a Session or Logger), you had to update **every single file**. Now, you only update `index.php`.
2. **Unified Routing**: Every request passes through a single gateway, allowing for a consistent way to handle all incoming traffic.
3. **URL Decoupling**: We finally separate the **URL** (the request) from the **File Path** (the logic). This allows us to have "Pretty URLs" like `/todo/create` while keeping the actual code organized in a private `logic/` folder.
4. **Global Request Handling**: It provides a single place to inspect or modify all incoming data (the foundation for future "Middleware").

## Characteristics

- **Single Entry Point**: All URLs are processed by `index.php`.
- **Pretty URLs**: Uses `$_SERVER['REQUEST_URI']` to determine the route instead of query parameters.
- **URL Helper**: Introduction of `url()` to generate consistent paths.
- **Logic & View Separation**: Files are split into `logic/` (processing) and `views/` (presentation).
- **Whitelisted Routing**: Ensures only valid routes are executed.

## The Evolution: What Changed?

| Feature | Pattern 02 (Refactored) | Pattern 03 (Front Controller) |
| :--- | :--- | :--- |
| **Front Door** | Multiple (`create.php`, etc.) | Single (`index.php`) |
| **URL Format** | `create.php`, `read.php` | `/todo/create`, `/categories/index` |
| **Bootstrapping** | Repeated in every file | Once in `index.php` |

## Observations for Learning

- **Request Parsing**: Look at `index.php`. Notice how it calculates the `$base_path` to ensure the application works correctly even if it's not at the domain root.
- **Cleaner Views**: Compare **[views/todo/index.php](./views/todo/index.php)** with previous versions. The HTML is no longer cluttered with database connection code or complex path calculations.

> [!IMPORTANT]
> **Known Issue: Direct File Access**  
> While we have a single entry point, sub-files (like those in `logic/` or `views/`) can still be accessed directly via their URL path if a user knows it. In a production environment, this is usually handled by moving these files outside the web root or using server-level restrictions (like `.htaccess`). For the sake of simplicity in this educational project, advanced entry point protection is considered **out of scope**.

## What's still missing?

- **Manual Routing**: We are still manually whitelisting strings.
- **Global Dependencies**: We still rely on `global $pdo`.
- **View Boilerplate**: `logic/` files still have to manually `require` view files.

---
Previous Pattern: **[02-refactored-procedural](../02-refactored-procedural/)**  
Next Pattern: **[04-modern-infrastructure](../04-modern-infrastructure/)**
