<?php

$server = "mysql:host=localhost;port=3306;dbname=todolist";
$dbusername = "root";
$dbpwd = "";

try {
    $pdo = new PDO($server, $dbusername, $dbpwd);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /* echo "connected"; */
} catch (PDOException $e) {
    die("Connection failed". $e -> getMessage());
}