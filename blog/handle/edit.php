<?php 

require_once "../inc/connection.php";


if(isset($_POST['submit']) && isset($_GET["id"])){
    $id = $_GET["id"];

    $title = $_POST['title'];
    $body = $_POST['body'];
    $image = $_FILES["image"];
    $imageName = $image['name'];
    $imagetmpName = $image['tmp_name'];
    $imageSize = $image['size']/(1024*1024);
    $imageExt =strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
    $imageError = $image['error'];

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

    $query = "select id , image from posts where id =$id";
    $runquery = mysqli_query($conn , $query);
    if (mysqli_num_rows($runquery)== 1 ){
        $post = mysqli_fetch_assoc($runquery);

        $oldImage = $post['image'];

        if(!empty($_FILES['image']['name'])){
            $imageExtArr = ["jpg" , "jpeg" , "png" , "gif"];
            if ($imageError > 0){
                $errors[] = "image is required";
            }elseif($imageSize > 1){
                $errors[] = "image is large";
            }elseif(! in_array($imageExt , $imageExtArr)){
                $errors[] = "choose a valid image";
            }
            unlink("../uploads/" . $post['image']);
            $newName = uniqid() . ".$imageExt";
        }else{
            $newName = $oldImage;
        }

        if (empty($errors)){
            $query = "UPDATE posts SET `title` = '$title' , `body` = '$body' , `image` = '$newName' where id =$id";
            $runQuery = mysqli_query($conn , $query);
            if($runQuery){
            move_uploaded_file($imagetmpName, "../uploads/$newName");
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
        $_SESSION["errors"] = ["choose correct op"];
        header("location: ../index.php");
    }
}else{
    $_SESSION["errors"] = ["choose correct op"];
        header("location: ../index.php");
}