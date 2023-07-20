<?php


include "../Controller/common/commonFunction.php";

session_start();
$username = $_POST["username"];

if (isset($_POST["username"])) {
    $_SESSION["username"] = $username;
}

if (!isset($_SESSION["username"])) {
    header('Location: ./login.php'); // redirect 
} 


// DB Connection
include "../Model/model.php";

$sql = $pdo->prepare(
    "SELECT * FROM users WHERE def_flg = 0"
);
$sql->execute(); // real sql run 

$_SESSION["users"]  = $sql->fetchAll(PDO::FETCH_ASSOC);
// DB Connection


header("Location: ../View/dashboard.php");



?>