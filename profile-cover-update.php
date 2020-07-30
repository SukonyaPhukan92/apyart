<?php
include "database/db.php";
session_start();
$msg = ""; 
if (isset($_POST['coverpic'])) {
		
	$filename = $_FILES["updatecover"]["name"]; 
    $tempname = $_FILES["updatecover"]["tmp_name"];     
	$folder = "img/uploads/profile/".$filename; 
	

$query ="UPDATE artist SET coverpic= '$filename' WHERE email = '" . $_SESSION['email'] . "' ";

 // Now let's move the uploaded image into the folder: image 
 if (move_uploaded_file($tempname, $folder))  { 
    $msg = "uploaded"; 
}else{ 
	$msg = "Failed to upload image"; 
} 
if ($con->query($query)) {
    echo "<script type='text/javascript'>window.location='profile.php';</script>";
}else{
    echo "<script type='text/javascript'>window.location='profile.php';</script>";
}

    }


?>