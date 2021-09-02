<?php
if (isset($_POST['signup-submit'])) {
  
    require 'dbh.inc.php';
   
    $username = $_POST['uid'];
   $email = $_POST['mail'];
   $pwd = $_POST['pwd'];
   $passwordRepeat = $_POST['pwd-repeat'];

   if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
   }
   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("location: ../signup.php?error=invaliduidmail=");
    exit(); 
   }
   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("location: ../signup.php?error=invalidmail&uid=".$username);
    exit(); 
   }
   elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("location: ../signup.php?error=invaliduid&mail=".$email);
    exit(); 
   }
   elseif ($password !== $passwordRepeat) {
    header("location: ../signup.php?error=passwordcheckuid=".$username."&mail=".$email);
    exit(); 
   }
   else {
       $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
       $stmt = mysqli_stmt_init($conn);
       if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=sqlerror");
        exit(); 
       }
       else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_results($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
            header("location: ../signup.php?error=usertaken&mail=".$email);
            exit(); 
        }
        else {
            $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
        }
       }
   }
}