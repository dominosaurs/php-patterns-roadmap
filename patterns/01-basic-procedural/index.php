<?php
require_once '../../database/pdo.php';

// Fetch todos with category and tags
$sql = "SELECT 
            todos.*, 
            categories.name as category_name, 
            categories.color as category_color,
            GROUP_CONCAT(tags.name) as tag_names
        FROM todos 
        LEFT JOIN categories ON todos.category_id = categories.id 
        LEFT JOIN todo_tags ON todos.id = todo_tags.todo_id
        LEFT JOIN tags ON todo_tags.tag_id = tags.id
        GROUP BY todos.id
        ORDER BY todos.is_completed ASC, todos.created_at DESC";

$statement = $pdo->prepare($sql);
$statement->execute();
$todos = $statement->fetchAll();

$title = 'Todo List';
include '_includes/header.php';
?>

<?php if (empty($todos)): ?>
    <article>
        <p>
            <code>No todos found. Start by <a href="create.php">adding your first task</a>.</code>
        </p>
    </article>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th style="width: 50px;">Status</th>
                <th>Task</th>
                <th>Category & Tags</th>
                <th style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos as $todo): ?>
                <tr>
                    <td style="text-align: center;">
                        <?= $todo['is_completed'] ? '✅' : '⏳' ?>
                    </td>
                    <td>
                        <a href="read.php?id=<?= $todo['id'] ?>">
                            <strong><?= htmlspecialchars($todo['name']) ?></strong>
                        </a>
                    </td>
                    <td>
                        <?php if ($todo['category_name']): ?>
                            <mark style="background-color: <?= $todo['category_color'] ?? '#eee' ?>; color: white;">
                                <?= htmlspecialchars($todo['category_name']) ?>
                            </mark>
                        <?php endif; ?>

                        <?php if ($todo['tag_names']): ?>
                            <?php foreach (explode(',', $todo['tag_names']) as $tag): ?>
                                <code>#<?= htmlspecialchars($tag) ?></code>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="update.php?id=<?= $todo['id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<p>
    <a href="create.php" class="button">Add New Todo</a>
</p>

<?php include '_includes/footer.php'; ?>