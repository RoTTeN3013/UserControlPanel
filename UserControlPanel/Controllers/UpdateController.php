<?php

session_start();

require "../Database/connection.php";
$user_id = $_SESSION["user_id"];

$errors = [];
$success = [];

$update_name = false;
$update_email = false;

if ($_POST) {

    if (empty($_POST["name"]) && empty($_POST["email"])) {
        $errors[] = "Legalább egy adat megadása kötelező.";
    } else {
        if ($_POST["name"]) {
            if (strlen($_POST["name"]) < 4 || strlen($_POST["name"]) > 24) {
                $errors[] = "A név minimum 4 és maximum 24 karakter között lehet.";
            } else {
                $new_name = $_POST["name"];
                $result = mysqli_query($connection, "SELECT * FROM users WHERE name = '$new_name' LIMIT 1");
                if (mysqli_num_rows($result) != 0) {
                    $errors[] = "A megadott név már létezik.";
                } else {
                    $update_name = true;
                }
            }
        }

        if ($_POST["email"]) {
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Valós email cím megadása kötzelező.";
            } else {
                $new_email = $_POST["email"];
                $result = mysqli_query($connection, "SELECT * FROM users WHERE email = '$new_email' LIMIT 1");
                if (mysqli_num_rows($result) != 0) {
                    $errors[] = "A megadott email cím már létezik.";
                } else {
                    $update_email = true;
                }
            }
        }
    }

    //Hibák lekérdezése (csak teljes hiba nélküli mentés engedélyezve)

    if ($update_name == true) {
        if (empty($errors)) {
            mysqli_query($connection, "UPDATE users SET name='$new_name' WHERE id='$user_id'");
            $success[] = "A felhasználó neve sikeresen módosítva.";
        }
    }

    if ($update_email == true) {
        if (empty($errors)) {
            mysqli_query($connection, "UPDATE users SET email='$new_email' WHERE id='$user_id'");
            $success[] = "A felhasználó email címe sikeresen módosítva.";
        }
    }

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        header('location: ../Views/user_edit.php');
    }

    if (!empty($success)) {
        $_SESSION["success"] = $success;
        header('location: ../Views/user_edit.php');
    }
}
