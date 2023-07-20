<?php
ini_set('display_errors', 1);
// Direct Access ?
if(count($_POST) == 0){
    header("Location: ../View/errors/error.php");
}else{
    $id = $_POST["id"];
    $name = $_POST["username"];
    $age = $_POST["age"];
    $class = $_POST["class"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $mark = $_POST["mark"];
    $phone = $_POST["phone"];

    include "../Model/model.php";

    $sql = $pdo->prepare(
        " UPDATE users SET
            name = :name,
            age= :age,
            class = :class,
            address = :address,
            gender = :gender,
            mark = :mark,
            phone=:phone
           WHERE id=:id 
        "
    );
    $sql->bindValue(":name",$name);
    $sql->bindValue(":age", $age);
    $sql->bindValue(":class", $class);
    $sql->bindValue(":address", $address);
    $sql->bindValue(":gender", $gender);
    $sql->bindValue(":mark", $mark);
    $sql->bindValue(":phone", $phone);
    $sql->bindValue(":id", $id);
    $sql->execute();

    header("Location: ./DashboardController.php");

}
