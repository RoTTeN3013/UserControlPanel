<?php

session_start();

require "../Database/connection.php";

$success = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //ABC sorrend (név szűrése)
    if ($_GET["filter"] == "by_name") {
        $result = mysqli_query($connection, "SELECT * FROM users ORDER BY name ASC");
        $success[] = "Felhasználók listája szűrve (ABC sorrend)";
    }
    //Regisztráció dűtuma szerint (legkorábbitól)
    if ($_GET["filter"] == "by_date_earliest") {
        $result = mysqli_query($connection, "SELECT * FROM users ORDER BY created_at ASC");
        $success[] = "Felhasználók listája szűrve (Regissztráció dátuma - Korábbiak elől)";
    }
    //Regisztráció dűtuma szerint (legújabbtól)
    if ($_GET["filter"] == "by_date_latest") {
        $result = mysqli_query($connection, "SELECT * FROM users ORDER BY created_at DESC");
        $success[] = "Felhasználók listája szűrve (Regissztráció dátuma - Késsőbbiek elől)";
    }
    $_SESSION["filtered_result"] = $result->fetch_all(MYSQLI_ASSOC);
    $_SESSION["success"] = $success;
    header('location: ../Views/users.php');
} else {
    //Nincs hozzáférés URL-ből
    header('location: ../index.html');
}
