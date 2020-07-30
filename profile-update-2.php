<?php
include "database/db.php";
session_start();
if (isset($_POST['linkupdate'])) {

    $website = stripslashes($_REQUEST['website']);
    $website = mysqli_real_escape_string($con,$website);

    $fb = stripslashes($_REQUEST['fb']);
    $fb = mysqli_real_escape_string($con,$fb);

    $insta = stripslashes($_REQUEST['insta']);
    $insta = mysqli_real_escape_string($con,$insta);

    $wa = stripslashes($_REQUEST['wa']);
	$wa = mysqli_real_escape_string($con,$wa);
	
$query ="UPDATE socialmedia SET website = '$website', fb = '$fb', insta = '$insta', wa = '$wa' WHERE email = '" . $_SESSION['email'] . "' ";
 
	if ($con->query($query)) {
		echo "<script type='text/javascript'>window.location='profile.php';</script>";
	}else{
		echo "<script type='text/javascript'>window.location='profile.php';</script>";
	}

		}

?>