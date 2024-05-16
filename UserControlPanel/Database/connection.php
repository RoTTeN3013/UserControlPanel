<?php

$default_database = array(
    "database" => "ucp",
    "host" => "localhost",
    "username" => "root",
    "password" => "",
    "port" => "3306"
);

$connection = mysqli_connect($default_database["host"], $default_database["username"], $default_database["password"], $default_database["database"]);

//Kapcsolat ellenőrzése

if ($connection->connect_errno) {
    echo "[Adatbázis] Sikertelen kapcsolódás: " . $connection->connect_error;
    exit();
}
