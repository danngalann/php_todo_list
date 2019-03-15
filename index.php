<?php

require_once 'app/init.php';
$itemsQuery = $db->prepare("
    SELECT id, description, done
    FROM items
    WHERE user = :user
");

$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];
$items = $itemsQuery;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO LIST</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Shadows+Into+Light+Two" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="list">
        <h1 class="header">To do list.</h1>

        <?php if(!empty($items)): ?>
            <ul class="items">
                <?php foreach($items as $item): ?>
                    <li>
                        <span class="item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php if(!$item['done']): ?>
                            <a href="mark.php?as=done&item=<?php echo $item['id']  ?>" class="done-button">Done</a>
                        <?php else: ?>
                            <a href="mark.php?as=undo&item=<?php echo $item['id']  ?>" class="done-button">Undo</a>                            
                        <?php endif; ?>
                        <a href="mark.php?as=delete&item=<?php echo $item['id']  ?>" class="done-button">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form class="item-add" action="add.php" method="post">
            <input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required>
        </form>
    </div>
</body>
</html>