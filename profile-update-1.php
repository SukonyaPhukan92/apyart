<?php
error_reporting(0); 
?> 
<?php
include "database/db.php";
session_start();

if (isset($_POST['submit'])) {
    $newbio = stripslashes($_REQUEST['newbio']);
	$newbio = mysqli_real_escape_string($con,$newbio);
	
$query ="UPDATE artist SET bio = '$newbio' WHERE email = '" . $_SESSION['email'] . "' ";
 
	if ($con->query($query)) {
		echo "<script type='text/javascript'>window.location='profile.php';</script>";
	}else{
		echo "<script type='text/javascript'>window.location='profile.php';</script>";
	}

		}

?>