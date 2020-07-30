<?php
include "admin-auth.php";
?>
<?php
include "../database/db.php";
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
    <h3>Feedback</h3>
<table>
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Message</th>
    <th>Date</th>
    </tr>
<?php 
include "../database/db.php";
$get = mysqli_query($con,"SELECT * FROM feedback");

while ($con=mysqli_fetch_array($get)){
$id=$con['id'];
$name=$con['name'];
$msg=$con['msg'];
$date=$con['date'];
?>
    <tr>
        <td><?php echo $id;?></td>
        <td><?php echo $name;?></td>
        <td><?php echo $msg;?></td>
        <td><?php echo $date;?></td>
    </tr>
<?php } ?>
</table>
</div>
</div>
</body>
</html>