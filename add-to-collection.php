<?php 
session_start();
if(isset($_SESSION['login_user'])){
    $user_id = $_SESSION['login_user'];
  }else{
    $user_id = '';
  }
include "database/db.php";
$artwork_id = $_REQUEST['id'];
$check = mysqli_query($con,"SELECT * from `collection` where artwork_id='$artwork_id' AND user_id='$user_id'");
$checkrows = mysqli_num_rows($check);
if($checkrows>0) {
$error = 'Already added to collection';
echo "<script type='text/javascript'>window.location='artist-artwork.php?id=".$artwork_id."&msg=".$error."';</script> ";
} else {

$query = "INSERT into `collection` (artwork_id, user_id) VALUES ('$artwork_id', '$user_id')";
    
$result = mysqli_query($con,$query);
if($result){
    $sucess='Sucessfully added to collection';
    echo "<script type='text/javascript'>window.location='artist-artwork.php?id=".$artwork_id."&msg=".$sucess."';</script> ";
}
}
?>