<?php
include "admin-auth.php";
$art_id = $_REQUEST['id']; 
$query ="DELETE FROM artwork WHERE id = '$art_id' ";
	if ($con->query($query)) {
        $msg = 'Artwork successfully Deleted';
		echo "<script type='text/javascript'>window.location='artwork-admin.php?msg=$msg';</script>";
	}else{
        $msg = 'Something went wrong';
		echo "<script type='text/javascript'>window.location='artwork-admin.php?msg=$msg';</script>";
	}
?>