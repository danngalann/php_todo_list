<?php 

require_once 'app/init.php';

if(isset($_POST['name'])){
    $name = trim($_POST['name']);

    if(!empty($name)){
        $addedQuery = $db->prepare("
            INSERT INTO items (description, user, done, created) 
            VALUES (:description, :user, 0, now())
        ");

        $addedQuery->execute([
            'description' => $name,
            'user' => $_SESSION['user_id']
        ]);
    }
}

header('Location: index.php');

?>