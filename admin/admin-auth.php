<?php
include "../database/db.php";
session_start();
if(!isset($_SESSION['admin_username'])){
    echo "<script type='text/javascript'>window.location='admin-login.php';</script>";
}
?>