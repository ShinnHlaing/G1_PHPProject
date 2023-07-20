<?php


session_start();

$id = $_GET["id"];

if(!isset($id)){
    header("Location: ../View/errors/error.php");
}else{
include  "../Model/model.php";

$sql = $pdo->prepare(
    "SELECT * FROM users WHERE id = :id
    "
);

$sql->bindValue(":id",$id);
$sql->execute();

$_SESSION["edituser"]= $sql->fetchAll(PDO::FETCH_ASSOC);


header("Location: ../View/user/edit.php");


}
