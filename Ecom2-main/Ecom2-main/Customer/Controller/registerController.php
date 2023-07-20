<?php
include "./common/mailSender.php";
ini_set('display_errors', 1);
session_start();
// check from stage is  register page or not 
 if(isset($_POST["register"])){
    $email = $_POST["email"];
    $passwords = $_POST["password"];

    //Db Connection
    include "../Model/model.php";

    //check duplicate email
    $sql = $pdo->prepare(
        "SELECT * FROM customers WHERE email=:email"
    );
    $sql->bindValue(":email",$email);
    $sql->execute();

    $resultEmail = $sql->fetchAll(PDO::FETCH_ASSOC);

    if(count($resultEmail) == 0){
        // register
        $sql = $pdo->prepare(
            "INSERT INTO customers
            (
                email,
                password,
                create_date
            )
            VALUES
            (
                :email,
                :password,
                :createdate
            )
        "
        );

        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", password_hash($passwords, PASSWORD_DEFAULT));
        $sql->bindValue(":createdate", date("Y-m-d"));
        $sql->execute();

        //send welcome email
        $body = file_get_contents("../Mail/welcome_template/index.html");
        $imglist = [
            "../Mail/welcome_template/images/image-1.png",
            "../Mail/welcome_template/images/image-2.png",
            "../Mail/welcome_template/images/image-3.png",
            "../Mail/welcome_template/images/image-4.png",
            "../Mail/welcome_template/images/image-5.png",
            "../Mail/welcome_template/images/image-6.gif"
        ];
        $mail =new SendMail();
        $mail->sendMail(
            $email,
            "Welcome From Ecom",
            $body,
            $imglist
        );


        // header("Location: ../View/dashboard.php");

    }else{
        $_SESSION["registerError"] = "Email is Duplicate!";
        header("Location: ../View/register.php");
    }
 }else {
    // go to error page
    header("Location: ../View/errors/error.php");
 }


?>
