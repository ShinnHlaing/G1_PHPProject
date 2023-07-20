<?php
session_start();

// check from stage is  register page or not 
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $passwords = $_POST["password"];

    //Db Connection
    include "../Model/model.php";

    $sql = $pdo->prepare(
        "SELECT * FROM customers WHERE email=:email"
    );

    $sql->bindValue(":email",$email);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    if(count($result) == 0){
        $_SESSION["loginerror"] = "Email not found!";
        header("Location: ../View/login.php");  
    }else {
       if(password_verify($passwords,$result[0]["password"])){
            header("Location: ../View/dashboard.php");
       }else{
            $_SESSION["loginerror"] = "Email or password incorrect!";
            header("Location: ../View/login.php");
       }
    }

} else {
    // go to error page
    header("Location: ../View/errors/error.php");
}
