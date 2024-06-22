<?php

require_once '../inc/connection.php';



if (isset($_POST["submit"])){


    $title = $_POST['title'];
    $body = $_POST['body'];
    $image = $_FILES["image"];
    $imageName = $image['name'];
    $imagetmpName = $image['tmp_name'];
    $imageSize = $image['size']/(1024*1024);
    $imageExt =strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
    $imageError = $image['error'];

    $imageNewName = uniqid() . ".$imageExt";


    //validation
    $errors = [];
    if (empty($title)){
        $errors[] = "title is required"; 
    }elseif (is_numeric($title)){
        $errors[] = "title is not correct";
    }
    if (empty($body)){
        $errors[] = "body is required"; 
    }elseif (is_numeric($body)){
        $errors[] = "body is not correct";
    }
    $imageExtArr = ["jpg" , "jpeg" , "png" , "gif"];
    if ($imageError > 0){
        $errors[] = "image is required";
    }elseif($imageSize > 1){
        $errors[] = "image is large";
    }elseif(! in_array($imageExt , $imageExtArr)){
        $errors[] = "choose a valid image";
    }

    if (isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    }
    

    if (empty($errors)){
        $query = "INSERT INTO posts(`title` , `body`,`image`,`user_id`) values ('$title' , '$body' , '$imageNewName',$user_id)";
        $runQuery = mysqli_query($conn , $query);

        if($runQuery){
            move_uploaded_file($imagetmpName , "../uploads/$imageNewName");
            $_SESSION['sucess'] = 'added sucsessfully';
            header("location: ../index.php");
        }else{
            $_SESSION['errors'] = "error while adding post";
            header("location: ../addpost.php"); 
        }
    }else{
        $_SESSION['errors'] = $errors;
        header("location: ../addpost.php");
    }

}else{
    header("location: ../addpost.php");
}