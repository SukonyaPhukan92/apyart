<?php
include "database/db.php";
session_start();
if(!isset($_SESSION['email'])){
  echo "<script type='text/javascript'>window.location='login.php';</script> ";
}else{
$art_id = $_REQUEST['id'];
$uploader = $_REQUEST['artist'];
  $sql = "SELECT id FROM artist WHERE email = '" . $_SESSION['email'] . "' ";
  $result = $con->query($sql);
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $artist_id_check=$row['id'];
  if(!isset($artist_id_check)){
    echo "<script type='text/javascript'>window.location='index.php';</script> ";
  }
  if(isset($artist_id_check)){
  if($artist_id_check == $uploader){
$query = "DELETE FROM artwork where id = '$art_id'";
$result = mysqli_query($con,$query);
echo "<script type='text/javascript'>window.location='profile.php';</script> ";
}else{
  echo "<script type='text/javascript'>window.location='error-404.php';</script>";
}
}else{
    "<script type='text/javascript'>window.location='login.php';</script>";
}
}
?>