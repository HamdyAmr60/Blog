<?php 

require_once '../inc/connection.php';

unset ($_SESSION['id']);
header("location: ../index.php");

?>