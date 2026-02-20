# 🐘 03-front-controller-routing

This pattern moves the application from multiple entry points to a single **Front Controller** (`index.php`). All requests now pass through one file, which centralizes shared logic and routing using **Pretty URLs**.

## 🎯 Why is this important?

In Patterns 01 and 02, your application had "multiple front doors" (e.g., `create.php`, `update.php`, `delete.php`). This created several problems that Pattern 03 solves:

1. **Centralized Bootstrapping**: Previously, every file had to manually include `pdo.php` and `functions.php`. If you added a new global tool (like a Session or Logger), you had to update **every single file**. Now, you only update `index.php`.
2. **Unified Security**: With multiple entry points, every file is a potential target for direct access. By using a Front Controller with `APP_ACCESS` protection, we close all "back doors" and ensure every request passes through our security whitelist.
3. **URL Decoupling**: We finally separate the **URL** (the request) from the **File Path** (the logic). This allows us to have "Pretty URLs" like `/todo/create` while keeping the actual code organized in a private `logic/` folder.
4. **Global Request Handling**: It provides a single place to inspect or modify all incoming data (the foundation for future "Middleware").

## Characteristics

- **Single Entry Point**: All URLs are processed by `index.php`.
- **Entry Point Protection**: Prevents direct access to logic and view files using the `APP_ACCESS` constant.
- **Pretty URLs**: Uses `$_SERVER['REQUEST_URI']` to determine the route instead of query parameters.
- **URL Helper**: Introduction of `url()` to generate consistent paths.
- **Logic & View Separation**: Files are split into `logic/` (processing) and `views/` (presentation).
- **Whitelisted Routing**: Ensures only valid routes are executed.

## The Evolution: What Changed?

| Feature | Pattern 02 (Refactored) | Pattern 03 (Front Controller) |
| :--- | :--- | :--- |
| **Front Door** | Multiple (`create.php`, etc.) | Single (`index.php`) |
| **URL Format** | `create.php`, `read.php` | `/todo/create`, `/categories/index` |
| **Security** | Files can be accessed directly | **Entry Point Protection** via `APP_ACCESS` |
| **Bootstrapping** | Repeated in every file | Once in `index.php` |

## Observations for Learning

- **The "Die" Guard**: Notice the first line in sub-files: `defined('APP_ACCESS') || die(...);`. This is how we enforce that the Front Controller is the only way in.
- **Clean Templates**: Compare **[views/todo/index.php](./views/todo/index.php)** with previous versions. The HTML is no longer cluttered with database connection code or complex path calculations.

## What's still missing?

- **Manual Routing**: We are still manually whitelisting strings.
- **Global Dependencies**: We still rely on `global $pdo`.
- **View Boilerplate**: `logic/` files still have to manually `require` view files.

---
Previous Pattern: **[02-refactored-procedural](../02-refactored-procedural/)**  
Next Pattern: **04-autoloading-psr4** (Planned)
