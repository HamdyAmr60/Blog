<?php
    require_once '../inc/connection.php';



    if(isset($_POST['submit']) && isset($_GET["id"])){
        $id = $_GET["id"];
        $query = "select id from posts where id = $id";
        $runquery = mysqli_query($conn , $query);
        if (mysqli_num_rows($runquery)== 1 ){

            $post = mysqli_fetch_assoc($runquery);


            unlink("../uploads/" . $post['image']);
            $query = "delete from posts where id= $id";

            $runquery = mysqli_query($conn , $query);

            if($runquery){
                header("location: ../index.php");
            }else{
                $_SESSION["errors"] = "delete not sucess";
            }
        }


    }else{
        $_SESSION["errors"] = ["choose correct op"];
        header("location: ../index.php");
    }
?>