<?php

$id = $_GET["id"];

include "../Model/model.php";

$sql = $pdo->prepare(
    " UPDATE users SET
        def_flg = 1
       WHERE id = :id 
    "
);

$sql->bindValue(":id",$id);

$sql->execute();

header("Location: ./DashboardController.php");







?>