# 🐘 01-basic-procedural

This pattern represents a raw PHP implementation where logic and presentation are tightly coupled in a single file per request.

## Characteristics

- **No Abstraction**: SQL queries and database connection logic are written directly within the page files.
- **File-based Routing**: Each `.php` file in the directory corresponds to a specific URL path.
- **Global State**: Reliance on global variables and direct superglobal (`$_POST`, `$_GET`) access without sanitization layers.
- **Minimal Dryness**: High code duplication for repetitive tasks like fetching categories or tags.

## Observations for Learning

- Notice the repetition of database connection and standard query logic across `index.php`, `create.php`, and `update.php`.
- Observe how HTML and PHP are interspersed, making the code harder to read as the application grows.
- Identify the difficulty of changing the database schema or UI structure when every file must be updated manually.

---
Next Pattern: [02-refactored-procedural](../02-refactored-procedural/)
