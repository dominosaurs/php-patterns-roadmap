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
        <p><a href="/">🐘 Back to Roadmap Dashboard</a></p>
        <h1><?= $title ?></h1>
        <p><small>Pattern: <strong>03-front-controller-routing 🐘</strong></small></p>
        <nav>
            <a href="<?= url('todo/index') ?>" class="<?= is_active_route('todo/') ? 'current' : '' ?>">Home</a> •
            <a href="<?= url('categories/index') ?>"
                class="<?= is_active_route('categories/') ? 'current' : '' ?>">Categories</a> •
            <a href="<?= url('tags/index') ?>" class="<?= is_active_route('tags/') ? 'current' : '' ?>">Tags</a>
        </nav>
    </header>

    <main>