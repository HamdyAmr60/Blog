<?php 

require_once '../inc/connection.php';

if (isset($_POST['submit'])){

    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));
    $phone = trim(htmlspecialchars($_POST['phone']));

    $errors = [];
    if (empty($name)){
        $errors[] = "name is required";
    }elseif(is_numeric($name)){
        $errors[] = "invalid name";
    }elseif (strlen($name)>100){
        $errors[] = "to much letters please less than 100 chars";
    }

    if (empty($email)){
        $errors[] = "email is required";
    }elseif(! filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[] = "invalid email";
    }elseif (strlen($email)>100){
        $errors[] = "to much letters please less than 100 chars";
    }

    if (empty($password)){
        $errors[] = "password is required";
    }elseif(! is_string($password)){
        $errors[] = "invalid password";
    }elseif (strlen($password)< 6){
        $errors[] = "password must be more than 6 char";
    }

    if(! is_string($phone)){
        $errors[] = "invalid phone";
    }elseif (strlen($password)> 15){
        $errors[] = "to much chars";
    }


    if (empty($errors)){
        $hashPass = password_hash($password,PASSWORD_DEFAULT);
        $query = "insert into users (`name` , `email` ,`password` , `phone`) values ('$name' , '$email' , '$hashPass' , '$phone')";

        $runQuery = mysqli_query($conn , $query);
        if ($runQuery){
            $_SESSION['sucess'] = "succsessful registeration";
        }else {
            $errors[] = "error while adding account";
         }
    }else{
        $_SESSION['errors'] = $errors;
    }
    
    header("location: ../register.php");

}else{
    header("location: ../index.php");
}

?>
