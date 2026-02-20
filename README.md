# 🐘 PHP Patterns Roadmap: A Beginner's Guide to Better Code 🚀

Welcome to the **🐘 PHP Patterns Roadmap**! This project is designed for PHP beginners who have just learned basic Object-Oriented Programming (OOP) and are wondering, "What's next?"

Most tutorials teach the "best way" immediately, which can be overwhelming. Here, we learn by **comparing**. We start with the most basic code, then step-by-step we improve it using industry patterns.

## 📝 The Case Study: To-Do App

At its core, this is a simple **To-Do List application** used as a study case to help you learn database relationships and architectural patterns:

- **Tasks (CRUD)**: Create, view, edit, and delete your to-do items.
- **Categories (One-to-Many)**: Every task can belong to one category (like *Work* or *Personal*).
- **Tags (Many-to-Many)**: Every task can have multiple labels (like *Urgent* or *Review*).

By exploring the different folders, you will see how these simple features are built using various coding styles.

## 🏛️ Project Philosophy

This project prioritizes **structural clarity** over features.

- **Pattern Isolation**: Each pattern is located in its own directory under the `patterns/` folder.
- **Shared Database**: All patterns share the same SQLite database (`database/database.sqlite`). This demonstrates that while the *code* (the pattern) changes, the *data* (the content) remains the same.
- **Zero Configuration**: No setup is required. The database is **automatically created and seeded** the first time you run the application.

## 🏁 Getting Started

Follow these steps to get the roadmap running on your local machine.

### 📋 Prerequisites

- **PHP 8.1+**: [Download PHP](https://www.php.net/downloads.php) (This project uses modern PHP features like types and improved PDO interactions).
- **PHP Extensions**:
  - `pdo_sqlite` (Required for the SQLite database)
  - `mbstring` (Recommended for string handling)

### 📥 Step 1: Get the Source Code

Choose one of the following methods:

#### Option A: Download ZIP (Easiest for Beginners)

1. **Download** the project as a ZIP file: [Download ZIP](https://github.com/dominosaurs/php-patterns-roadmap/archive/refs/heads/main.zip)
2. **Extract** the ZIP file to your local directory.

#### Option B: Clone via Git

```bash
git clone https://github.com/dominosaurs/php-patterns-roadmap.git
cd php-patterns-roadmap
```

### 🚀 Step 2: Run the Application

Simply use the PHP built-in server from the root directory:

```bash
php -S localhost:8000
```

Open [http://localhost:8000](http://localhost:8000) in your browser to see the roadmap dashboard.

## 🛠️ Database Management

If you want to **wipe all data** and reset the database to its initial empty state, you have two options:

1. **Via Script**: Run the migration script in your terminal:

    ```bash
    php database/migrate.php
    ```

2. **Via File**: Simply **delete** the `database/database.sqlite` file. The application will automatically recreate and re-seed it on the next page refresh.

## 🛤️ Pattern Roadmap (Evolution Path)

This project is a journey. Follow the folders in order to see how the code improves:

### Phase 1: The Basics

- **[01-basic-procedural](./patterns/01-basic-procedural/)** (Current)
  - Raw PHP. Logic, database, and HTML are all mixed together.
  - **Lesson**: Why "Spaghetti Code" is hard to read and maintain.
- **02-refactored-procedural** (Planned)
  - Moving logic into reusable functions.
  - **Lesson**: Don't Repeat Yourself (DRY).

### Phase 2: Centralization & Infrastructure

- **03-front-controller-routing** (Planned)
  - Moving from multi-file to a single `index.php` entry point.
  - **Lesson**: How to handle URLs and centralize your application logic.
- **04-autoloading-psr4** (Planned)
  - Using namespaces and automatic class loading.
  - **Lesson**: Say goodbye to writing `require_once` in every file.
- **05-middleware-pipeline** (Planned)
  - Intercepting requests for logging or data sanitization.
  - **Lesson**: How to add "Global Satpam" to clean and monitor your traffic.

### Phase 3: Object-Oriented Foundations

- **06-singleton-db-connection** (Planned)
  - Using the **Singleton** pattern for shared database resources.
  - **Lesson**: Managing global state and resource efficiency.
- **07-simple-mvc** (Planned)
  - Introduction to Model, View, and Controller.
  - **Lesson**: Separating the "Look" (UI) from the "Logic" (Code).
- **08-active-record** (Planned)
  - Objects that know how to save themselves (like Eloquent).
  - **Lesson**: Mapping database rows to PHP objects.

### Phase 4: Professional Abstraction

- **09-service-repository** (Planned)
  - Using Repositories for data and Services for business rules.
  - **Lesson**: Making your logic reusable and your database swappable.
- **10-dependency-injection** (Planned)
  - Passing dependencies into classes instead of hardcoding them.
  - **Lesson**: Writing decoupled, testable, and maintainable code.

### Phase 5: Modern Patterns

1. **11-action-domain-responder (ADR)** (Planned)
    - A modern evolution of MVC where every request is a single class.
    - **Lesson**: Keeping classes small and focused (Single Responsibility).
2. **12-dto-and-payloads** (Planned)
    - Using Data Transfer Objects (DTO) to move data between layers safely.
    - **Lesson**: Type safety and data integrity.

## ⚠️ Security Disclaimer

This entire project is created for **educational purposes only**. While the patterns become more professional as you progress, this codebase is not audited for production security.

- **Use at your own risk**: We do not recommend using this code in a live production environment without a thorough security review.
- **Educational Focus**: Some security practices (like CSRF protection, rate limiting, or advanced input validation) may be omitted or simplified to keep the focus on architectural patterns.

### 🛡️ Recommended Security Resources

To build production-ready applications, please study these essential resources:

- **[OWASP PHP Security Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/PHP_Configuration_Cheat_Sheet.html)** - Comprehensive guide to securing PHP apps.
- **[PHP The Right Way - Security](https://phptherightway.com/#security)** - Modern standards for PHP security.
- **[Paragon Initiative - PHP Security](https://paragonie.com/blog/2017/12/2018-guide-building-secure-php-software)** - Expert-level security advice.
