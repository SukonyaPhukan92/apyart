<?php
include "admin-auth.php";
$artist_id = $_REQUEST['id']; 
$artist_email = $_REQUEST['email'];
$query3 ="DELETE FROM users WHERE email = '$artist_email' ";
$con->query($query3);
$query ="DELETE FROM artist WHERE id = '$artist_id' ";
$con->query($query);
$check=mysqli_query($con,"SELECT * from artwork where uploader='$artist_id'");$checkrows=mysqli_num_rows($check);

if($checkrows>0) {
    $query2="DELETE FROM artwork WHERE uploader = '$artist_id'";
    $con->query($query2);
    $msg = 'Artist and user Succesfully deleted and artworks too';
    echo "<script type='text/javascript'>window.location='artist-admin.php?msg=$msg';</script>";
}else{
    $msg = 'Artist and user Succesfully deleted but no artworks was there';
    echo "<script type='text/javascript'>window.location='artist-admin.php?msg=$msg';</script>";
}
?>