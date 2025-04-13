<?php
declare(strict_types=1);

function get_username(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE user_name = :username;";
    $pstmt = $pdo -> prepare($query);
    $pstmt -> bindParam(":username", $username);
    $pstmt -> execute();

    $result =  $pstmt -> fetch(PDO::FETCH_ASSOC);
    return $result;
}