<?php

session_start();

require "../Database/connection.php";

$success = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (empty($_GET["search"])) {
        $errors[] = "Név megadása kötelező.";
        $_SESSION["errors"] = $errors;
        header('location: ../Views/users.php');
        exit();
    } else {
        $name = $_GET["search"];
        $result = mysqli_query($connection, "SELECT * FROM users WHERE name LIKE '%$name%'");
        if (mysqli_num_rows($result) == 0) {
            $errors[] = "A megadott névre (" . $name . ") nincs találat.";
            $_SESSION["errors"] = $errors;
            header('location: ../Views/users.php');
            exit();
        } else {
            $success[] = "Felhasználók listája a keresés alapján: (" . $name . ")";
            $_SESSION["filtered_result"] = $result->fetch_all(MYSQLI_ASSOC);
            $_SESSION["success"] = $success;
            header('location: ../Views/users.php');
        }
    }
} else {
    //Nincs hozzáférés URL-ből
    header('location: ../index.html');
}
