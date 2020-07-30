<?php
include "admin-auth.php";
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
    <h3 class="pg-title">Admin dashboard</h3>
    <h4>Hi <?php echo $_SESSION['admin_username'] ?></h4>
<?php
$abc="SELECT count(*) as user FROM users";
$abcs="SELECT count(*) as approvedartist FROM artist WHERE approval=1";
$abcs2="SELECT count(*) as nonappartist FROM artist WHERE approval=0";
$abcc="SELECT count(*) as art FROM artwork";
$abcm="SELECT count(*) as feedback FROM feedback";
$result=mysqli_query($con,$abc);
if($result)
{
    while($row=mysqli_fetch_assoc($result))
    {
    
        $total_user = $row['user'];
    }       
}

?>
<?php
$result2=mysqli_query($con,$abcs);
if($result2)
{
    while($row=mysqli_fetch_assoc($result2))
    {
        $total_appartist = $row['approvedartist'];
    }       
}
?>
<?php
$result2=mysqli_query($con,$abcs2);
if($result2)
{
    while($row=mysqli_fetch_assoc($result2))
    {
        $total_nonappartist = $row['nonappartist'];
    }       
}
?>
<?php
$result3=mysqli_query($con,$abcc);
if($result2)
{
    while($row=mysqli_fetch_assoc($result3))
    {
        $total_artwork = $row['art'];
    }       
}
?>
<?php
$result4=mysqli_query($con,$abcm);
if($result4)
{
    while($row=mysqli_fetch_assoc($result4))
    {
        $total_feedback = $row['feedback'];
    }       
}
?>

<div class="cards">
    <a href="users-admin.php">
    <div class="card" style="background-color: rgb(112, 66, 172)">
    <p class="count"><?php echo $total_user;?></p>
        <h4>total Users</h4>
    </div>
    </a>

    <a href="pending-approval-admin.php">
    <div class="card" style="background-color: rgb(66, 194, 211)">
    <p class="count"><?php echo $total_nonappartist;?></p>
        <h4>Non Approved Artist</h4> 
    </div></a>
    <a href="artist-admin.php">
    <div class="card" style="background-color: rgb(66, 194, 211)">
    <p class="count"><?php echo $total_appartist;?></p>
        <h4>Approved Artist</h4> 
    </div></a>
    <a href="artwork-admin.php">
    <div class="card" style="background-color: rgb(151, 202, 74)">
        <p class="count"><?php echo $total_artwork;?></p>    
        <h4>Total Artworks</h4>  
    </div></a>

    <a href="feedback-admin.php">
    <div class="card" style="background-color: rgb(230, 78, 78)">
    <p class="count"><?php echo $total_feedback;?></p>
        <h4>total Feedback</h4>
    </div>
    <a>
</div>











</div>
</body>
</html>