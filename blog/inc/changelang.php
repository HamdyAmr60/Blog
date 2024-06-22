

<?php 

session_start();
if (isset($_GET['lang'])){

    $lang = $_GET['lang'];
    if ($lang == "en"){
        $_SESSION['lang'] = "en";
    }else{
        $_SESSION['lang'] = "ar";
    }

    
    header("location:" . $_SERVER['HTTP_REFERER']);

}else{
    header("location:../index.php");
}

?>