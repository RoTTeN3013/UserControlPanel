<?php

session_start();
require "../Database/connection.php";
$user_id = $_SESSION["user_id"];

$success = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = mysqli_query($connection, "DELETE FROM users WHERE id='$user_id'");
    $success[] = "A kiválasztott felhasználó sikeresen törlésre került.";
    $_SESSION["success"] = $success;
    header('location: ../Views/users.php');
} else {
    //Nincs hozzáférés URL-ből
    header('location: ../index.html');
}
