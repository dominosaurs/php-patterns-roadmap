<?php
$title = '🐘 PHP Patterns Roadmap';
$patterns = array_filter(
    glob('patterns/*'),
    'is_dir'
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <header>
        <h1>🐘 PHP Patterns Roadmap</h1>
        <p>A beginner's journey from basic procedural code to industry-standard architectures.</p>
    </header>

    <main>
        <p>Follow the roadmap by selecting an evolution step below:</p>

        <?php foreach ($patterns as $path): ?>
            <?php $name = basename($path); ?>
            <article>
                <h3>
                    <a href="<?= $path ?>/">
                        <?= str_replace('-', ' ', ucwords($name, '-')) ?>
                    </a>
                </h3>
                <p>Architecture: <code><?= $name ?></code></p>
            </article>
        <?php endforeach; ?>
    </main>

    <footer>
        <p>🐘 Follow the <a href="README.md">README</a> for the complete roadmap documentation.</p>
    </footer>
</body>

</html>