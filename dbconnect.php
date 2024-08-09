<?php

require_once dirname(__FILE__) . "/env.php";
ini_set("display_errors", true);

function connect() {
    $host = DB_HOST;
    $name = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;

    $dsn = "mysql:host=$host;dbname=$name;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch(PDOException $e) {
        echo "connection failed...<br>";
        echo "Message: " . $e -> getMessage() . "<br>";
        echo "Line: " . $e -> getLine() . "<br>";
    }
}