<?php

session_start();

$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=php_todo_list;host=localhost','root','');

if(!isset($_SESSION['user_id'])){
    die("Not signed in");
}

?>