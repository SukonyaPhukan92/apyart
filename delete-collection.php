<?php 
session_start();
if(isset($_SESSION['login_user'])){
    $user_id = $_SESSION['login_user'];
  }else{
    $user_id = '';
  }
include "database/db.php";
$id = $_REQUEST['id'];
mysqli_query($con,"DELETE FROM collection where id = '$id'");
echo "<script type='text/javascript'>window.location='collection.php';</script> ";
?>