<?php

session_start();

require "../Database/connection.php";

//Hozzáférés megtagadása URL-ből
if (!isset($_GET["user_id"]) && !isset($_SESSION["user_id"])) {
    session_destroy();
    header('location: index.html');
    exit;
}

//User listából vagy visszatöltésből való betöltés.
if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];
} else if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
}

//Kiválasztott user adatainak lekérdezése
$result = mysqli_query($connection, "SELECT * FROM users WHERE id='$user_id' LIMIT 1");
$user = $result->fetch_assoc();

$_SESSION["user_id"] = $user_id;


//Session változók nullázása és változóba feltöltése
if (isset($_SESSION["errors"])) {
    $errors = $_SESSION["errors"];
    $_SESSION["errors"] = [];
}

if (isset($_SESSION["success"])) {
    $success = $_SESSION["success"];
    $_SESSION["success"] = [];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Control Panel - User edit</title>
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
        <h2>UCP - Felhasználó szerkesztése <br> (User ID: <?= $user_id ?>)</h2>
    </div>
    <div class="panel">
        <form action="../Controllers/UpdateController.php" method="POST">
            <input type="text" name="name" placeholder="<?= $user["name"] ?>">
            <input type="email" name="email" placeholder="<?= $user["email"] ?>">
            <input type="submit" class="panel_btn" value="Szerkesztés">
        </form>
        <a href="users.php">
            <button class="panel_btn">Vissza</button>
        </a>
    </div>
</body>

<!-- scriptek beolvasása !-->
<script src="../Scripts/jquery-3.7.1.js"></script>
<script src="../Scripts/notification.js"></script>


</html>