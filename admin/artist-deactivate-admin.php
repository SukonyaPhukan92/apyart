<?php
include "admin-auth.php";
$artist_id = $_REQUEST['id']; 
$query ="UPDATE artist SET ad = 0 WHERE id = '$artist_id' ";
$con->query($query);
$check=mysqli_query($con,"SELECT * from artwork where uploader='$artist_id'");$checkrows=mysqli_num_rows($check);

if($checkrows>0) {
    $query2="UPDATE artwork SET ad=0 WHERE uploader = '$artist_id'";
    $con->query($query2);
    $msg = 'Artist Succesfully deactivated and artworks too';
    echo "<script type='text/javascript'>window.location='artist-admin.php?msg=$msg';</script>";
}else{
    $msg = 'Artist succesfully deactivated no artworks was found';
    echo "<script type='text/javascript'>window.location='artist-admin.php?msg=$msg';</script>";
}
?>