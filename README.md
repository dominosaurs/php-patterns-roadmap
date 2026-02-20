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

- **PHP 8.1+**: [Download PHP](https://www.php.net/downloads.php) (This project uses modern PHP features).
- **Composer**: [Download Composer](https://getcomposer.org/download/) (Required for PSR-4 autoloading from Pattern 04 onwards).
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

### 🚀 Step 2: Initialize & Run

1. **Initialize autoloader**:

   ```bash
   composer install
   ```

2. **Run the application**:

   ```bash
   composer start
   ```

Open [http://localhost:8000](http://localhost:8000) in your browser to see the roadmap dashboard.

## 🛠️ Database Management

If you want to **wipe all data** and reset the database to its initial empty state, you have two options:

1. **Via Script**: Run the migration script in your terminal:

    ```bash
    composer migrate
    ```

2. **Via File**: Simply **delete** the `database/database.sqlite` file. The application will automatically recreate and re-seed it on the next page refresh.

## 🐘 Pattern Roadmap (Evolution Path)

This project is a journey. Follow the folders in order to see how the code improves:

### Phase 1: The Basics

- **[01-basic-procedural](./patterns/01-basic-procedural/)**
  - Raw PHP. Logic, database, and HTML are all mixed together.
  - **Lesson**: Why "Spaghetti Code" is hard to read and maintain.
- **[02-refactored-procedural](./patterns/02-refactored-procedural/)**
  - Moving logic into reusable functions.
  - **Lesson**: Don't Repeat Yourself (DRY).

### Phase 2: Standardized Infrastructure

- **[03-front-controller-routing](./patterns/03-front-controller-routing/)**
  - Moving from multi-file to a single `index.php` entry point.
  - **Lesson**: How to handle URLs and centralize your application logic.
- **[04-modern-infrastructure](./patterns/04-modern-infrastructure/)**
  - Unified infrastructure: PSR-4 Autoloading, Singleton Database, and Middleware Pipeline.
  - **Lesson**: Building the robust "engine" that powers modern apps.
- **[05-dependency-injection-and-types](./patterns/05-dependency-injection-and-types/)**
  - Introduction to Dependency Injection, Strict Types, and Type Hinting.
  - **Lesson**: Writing safe, testable, and decoupled code.

### Phase 3: Object-Oriented Architecture

- **06-mvc-and-active-record** (Planned)
  - Full separation of Model, View, and Controller, combined with the Active Record pattern.
  - **Lesson**: Organizing logic into classes and mapping database rows to PHP objects.
- **07-service-repository** (Planned)
  - Using Repositories for data and Services for business rules.
  - **Lesson**: Making your logic reusable and your database swappable.

### Phase 4: Modern Patterns

1. **08-action-domain-responder (ADR)** (Planned)
    - A modern evolution of MVC where every request is a single class.
    - **Lesson**: Keeping classes small and focused (Single Responsibility).
2. **09-dto-and-payloads** (Planned)
    - Using Data Transfer Objects (DTO) to move data between layers safely.
    - **Lesson**: Type safety and data integrity.

## ⚠️ Security Disclaimer

This entire project is created for **educational purposes only**. While the patterns mature as you progress, this codebase is not audited for production security.

- **Use at your own risk**: We do not recommend using this code in a live production environment without a thorough security review.
- **Educational Focus**: Some security practices (like CSRF protection, rate limiting, or advanced input validation) may be omitted or simplified to keep the focus on architectural patterns.

### 🛡️ Recommended Security Resources

To build production-ready applications, please study these essential resources:

- **[OWASP PHP Security Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/PHP_Configuration_Cheat_Sheet.html)** - Comprehensive guide to securing PHP apps.
- **[PHP The Right Way - Security](https://phptherightway.com/#security)** - Modern standards for PHP security.
- **[Paragon Initiative - PHP Security](https://paragonie.com/blog/2017/12/2018-guide-building-secure-php-software)** - Expert-level security advice.
