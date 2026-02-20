<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> — 🐘 PHP Patterns Roadmap</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
            border: none;
        }

        th,
        td {
            padding: 0.75rem 1rem;
            text-align: left;
            border: none;
        }

        thead th {
            border-bottom: 2px solid var(--text-main);
            color: var(--text-main);
            font-weight: bold;
        }

        tr:hover {
            background-color: var(--accent-bg);
        }

        mark {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 0.8rem;
        }

        code {
            background: none;
            color: var(--text-light);
            padding: 0;
        }
    </style>
</head>

<body>
    <header>
        <?php
        $current_page = $_SERVER['SCRIPT_NAME'];
        $base = (strpos($current_page, 'categories/') !== false || strpos($current_page, 'tags/') !== false) ? '../' : '';
        ?>
        <p><a href="/">🐘 Back to Roadmap Dashboard</a></p>
        <h1><?= $title ?></h1>
        <p><small>Pattern: <strong>02-refactored-procedural 🐘</strong></small></p>
        <nav>
            <a href="<?= $base ?>index.php" class="<?= (is_active('index.php') && !$base) ? 'current' : '' ?>">Home</a> •
            <a href="<?= $base ?>categories/index.php" class="<?= is_active('categories/') ? 'current' : '' ?>">Categories</a> •
            <a href="<?= $base ?>tags/index.php" class="<?= is_active('tags/') ? 'current' : '' ?>">Tags</a>
        </nav>
    </header>

    <main>