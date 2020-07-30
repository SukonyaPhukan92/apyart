<?php
session_start();
include "database/db.php";
$name = $_GET['name'];
$profilepic = $_GET['profilepic'];
$email = $_GET['email'];
$reg_date = date("Y-m-d H:i:s");

$check=mysqli_query($con,"SELECT * from users where email='$email'");
$checkrows=mysqli_num_rows($check);

if($checkrows>0){
    $query1 = "SELECT * FROM `users` WHERE email='$email'";
	$result1 = mysqli_query($con,$query1) or die(mysql_error());
    $fetch_ida = mysqli_fetch_assoc($result1);
    $_SESSION['login_user'] = $fetch_ida['id'];
    $_SESSION['email'] = $email;
    $_SESSION['login_type'] = 1;
    echo "<script type='text/javascript'>window.location='https://digitalyashwant.tech/apyart/index.php';</script> ";
} else {
    $query = "INSERT into `users` (name, email, profilepic, reg_date) VALUES ('$name', '$email', '$profilepic', '$reg_date')";
    $result = mysqli_query($con,$query);
    if($result){
        $fetch_id = mysqli_fetch_assoc($result);
        $_SESSION['login_user'] = $fetch_id['id'];
        $_SESSION['email'] = $email;
        $_SESSION['login_type'] = 1;
        echo "<script type='text/javascript'>window.location='https://digitalyashwant.tech/apyart/index.php';</script> ";   
    }
}
?>