<?php
include "admin-auth.php";
if(isset($_REQUEST['msg'])){
$msg = $_REQUEST['msg'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel - Apyart</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/admin-style.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<?php include "sidebar.php"?>
<div class="content">
    <h3>Pending Artist Approval <i class="fa fa-id-card-o pending-ap-btn" aria-hidden="true"></i></h3>
    <p class="msg"><?php if(isset($msg)){ echo $msg;}?></p>
<table>
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Address</th>
    <th>Exp. Level</th>
    <th>Action</th>
    </tr>
<?php 
include "../database/db.php";
$get = mysqli_query($con,"SELECT id, name, email, mobile, country, state, city, explevel FROM artist WHERE approval = 0");
while ($con=mysqli_fetch_array($get)){
$id=$con['id'];
$name=$con['name'];
$email=$con['email'];
$mobile=$con['mobile'];
$country=$con['country'];
$state=$con['state'];
$city=$con['city'];
$explevel=$con['explevel'];
?>
    <tr>
        <td><?php echo $id;?></td>
        <td><?php echo $name;?></td>
        <td class="email"><?php echo $email;?></td>
        <td><?php echo $mobile;?></td>
        <td><?php echo $country; echo ','; echo $state; echo ','; echo $city;?></td>
        <td><?php echo $explevel;?></td>
        <td><a class="btn approve" href="artist-approve-admin.php?id=<?php echo $id;?>"><i class="fa fa-check" aria-hidden="true"></i></a></td>
    </tr>
<?php } ?>
</table>
</div>
</div>
</body>
</html>