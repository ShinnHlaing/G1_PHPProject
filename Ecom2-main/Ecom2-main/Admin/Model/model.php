<?php

$hostname = "localhost";
$port = 3307;
$dbname = "shopping_db";
$uname = "root";
$pwd = "";

//Connection
$pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$dbname",
    $uname,$pwd);

// set error exc
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

