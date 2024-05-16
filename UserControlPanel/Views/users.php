<?php

session_start();

require "../Database/connection.php";

if (!isset($_SESSION["filtered_result"])) {
    $users = mysqli_query($connection, "SELECT * FROM users");
} else {
    $users = $_SESSION["filtered_result"];
}

if (isset($_SESSION["errors"])) {
    $errors = $_SESSION["errors"];
    $_SESSION["errors"] = [];
    session_destroy();
}

if (isset($_SESSION["success"])) {
    $success = $_SESSION["success"];
    $_SESSION["success"] = [];
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Control Panel - All users</title>
    <link rel="stylesheet" href="../Design/style.css?v=<?php echo time(); ?>">
</head>

<body>

    <?php
    if (!empty($errors)) { ?>
        <div class="message_container">
            <?php foreach ($errors as $error) { ?>
                <div class="message_box">
                    <img src="../Design/Images/error.png" alt="error icon">
                    <p><?= $error ?></p>
                </div>
            <?php } ?>
        </div>
    <?php }

    if (!empty($success)) { ?>
        <div class="message_container">
            <?php foreach ($success as $success_msg) { ?>
                <div class="message_box">
                    <img src="../Design/Images/success.png" alt="success icon">
                    <p><?= $success_msg ?></p>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="logo_container">
        <img src="../Design/Images/admin.png" alt="user icon" class="logo">
        <h2>UCP - Felhasználók listája</h2>
        <a href="../index.html">
            <button class="panel_btn">Vissza</button>
        </a>
    </div>

    <form action="../Controllers/FilterController.php" method="GET" class="filter_form">
        <select name="filter">
            <option value="by_name">Név szerint ABC sorrend</option>
            <option value="by_date_earliest">Regisztráció dátuma szerint (növ)</option>
            <option value="by_date_latest">Regisztráció dátuma szerint (csökk)</option>
        </select>
        <input type="submit" value="Szűrés" class="panel_btn control_btn">
    </form>

    <form action="../Controllers/SearchController.php" method="GET" class="filter_form">
        <input type="text" name="search" placeholder="Keresés">
        <input type="submit" value="Szűrés" class="panel_btn control_btn">
    </form>

    <?php foreach ($users as $user) { ?>
        <div class="user_container">
            <div class="user_card">
                <img src="../Design/Images/name.png" alt="name icon">
                <p><?= $user["name"]; ?></p>
            </div>
            <div class="user_card">
                <img src="../Design/Images/email.png" alt="email icon" class="card_img_2">
                <p><?= $user["email"]; ?></p>
            </div>
            <div class="user_card">
                <img src="../Design/Images/date.png" alt="date icon" class="">
                <p><?= $user["created_at"]; ?></p>
            </div>
            <div class="user_card user-control">
                <form action="user_edit.php" method="GET">
                    <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
                    <input type="submit" value="Szerkesztés" class="panel_btn control_btn">
                </form>
            </div>
            <div class="user_card user-control">
                <form action="confirm_delete.php" method="GET">
                    <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
                    <input type="submit" value="Törlés" class="panel_btn control_btn">
                </form>
            </div>
        </div>
    <?php
    }
    ?>
    </div>
</body>

<!-- scriptek beolvasása !-->
<script src="../Scripts/jquery-3.7.1.js"></script>
<script src="../Scripts/notification.js"></script>

</html>