<?php
include "admin-auth.php";
$artist_id = $_REQUEST['id']; 
$query ="UPDATE artist SET approval = 1 WHERE id = '$artist_id' ";
 
	if ($con->query($query)) {
        $msg = 'Artist approved successfully';
		echo "<script type='text/javascript'>window.location='pending-approval-admin.php?msg=$msg';</script>";
	}else{
        $msg = 'Something went wrong';
		echo "<script type='text/javascript'>window.location='pending-approval-admin.php?msg=$msg';</script>";
	}
?>