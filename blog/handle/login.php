<?php

require_once '../inc/connection.php';



if (isset($_POST['submit'])){

    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));

    $errors = [];
    if (empty($email)){
        $errors[] = "email is required";
    }

    if (empty($password)){
        $errors[] = "password is required";
    }


    if (empty($errors)){
        $query = "select * from users where email = '$email'";

        $runQuery = mysqli_query($conn , $query);
        if (mysqli_num_rows($runQuery) == 1){
            $user = mysqli_fetch_assoc($runQuery);
            $sqpass = $user['password'];
            $result =password_verify($password , $sqpass);

            if ($result){
                $_SESSION['id'] = $user['id'];
                header("location: ../index.php");

            }else{
                $errors[] = "1";
                $_SESSION['errors'] = $errors;
                header("location: ../login.php");
            }
        }else {

            $errors[] = "2";
            $_SESSION['errors'] = $errors;
            header("location: ../login.php");
         }
    }else{
        $errors[] = "3";
        $_SESSION['errors'] = $errors;
        header("location: ../login.php");
    }
    
    
}else{
    $errors[] = "4";
    $_SESSION['errors'] = $errors;
    header("location: ../login.php");
}