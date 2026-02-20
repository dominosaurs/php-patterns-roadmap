<?php

use App\P04\Core\View;

?>

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

        nav a.current {
            text-decoration: underline;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <p><a href="/">🐘 Back to Roadmap Dashboard</a></p>
        <h1><?= $title ?></h1>
        <p><small>Pattern: <strong>04-modern-infrastructure 🐘</strong></small></p>
        <nav>
            <a href="<?= View::url('todo/index') ?>"
                class="<?= View::isActiveRoute('todo/') ? 'current' : '' ?>">Home</a> •
            <a href="<?= View::url('categories/index') ?>"
                class="<?= View::isActiveRoute('categories/') ? 'current' : '' ?>">Categories</a> •
            <a href="<?= View::url('tags/index') ?>"
                class="<?= View::isActiveRoute('tags/') ? 'current' : '' ?>">Tags</a>
        </nav>
    </header>

    <main>