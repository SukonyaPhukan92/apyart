<?php
include "admin-auth.php";
$user_id = $_REQUEST['id']; 
$query ="DELETE FROM users WHERE id = '$user_id ";
	if ($con->query($query)) {
        $msg = 'User account Deleted';
		echo "<script type='text/javascript'>window.location='users-admin.php?msg=$msg';</script>";
	}else{
        $msg = 'Something went wrong';
		echo "<script type='text/javascript'>window.location='users-admin.php?msg=$msg';</script>";
	}
?>