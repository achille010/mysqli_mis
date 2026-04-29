<?php

    require __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv -> load();

    $serverName = 'localhost';
    $userName = 'root';
    $passWord = $_ENV['MYSQL_PASSWORD'];
    $dbName = 'mysqli_school_management_db';
    $conn = new mysqli($serverName,
                    $userName,
                    $passWord,
                    $dbName);

    if($conn->connect_error){
        die("Connection failed!");
    }
    