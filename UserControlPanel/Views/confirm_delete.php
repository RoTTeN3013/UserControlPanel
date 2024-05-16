<?php

require "../Database/connection.php";

if ($_GET) {
    session_start();
    $user_id = $_GET["user_id"];
    $_SESSION["user_id"] = $user_id;
} else {
    header('location: index.html');
}

$result = mysqli_query($connection, "SELECT * FROM users WHERE id='$user_id' LIMIT 1");
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Control Panel - User delete</title>
    <link rel="stylesheet" href="../Design/style.css?v=<?php echo time(); ?>">
</head>

<body>

    <div class="logo_container">
        <img src="../Design/Images/admin.png" alt="user icon" class="logo">
        <h2>UCP - Felhasználó törlése</h2>
        <div class="user_data_container">
            <div class="user_card">
                <img src="../Design/Images/admin.png" alt="user icon">
                <p></p>User ID: <?= $user_id ?></p>
            </div>
            <div class="user_card">
                <img src="../Design/Images/name.png" alt="name icon">
                <p></p><?= $user["name"] ?></p>
            </div>
            <div class="user_card">
                <img src="../Design/Images/email.png" alt="email icon" class="card_img_2">
                <p></p><?= $user["email"] ?></p>
            </div>
        </div>
    </div>
    <div class="panel">
        <form action="../Controllers/DeleteController.php" method="POST">
            <input type="submit" class="panel_btn" value="Törlés">
        </form>
        <a href="users.php">
            <button class="panel_btn">Vissza</button>
        </a>
    </div>
</body>

</html>