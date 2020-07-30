<?php
include "admin-auth.php";
if(isset($_REQUEST['msg'])){
    $msg = $_REQUEST['msg'];
}
if(isset($_REQUEST['search']))
{
    $valueToSearch = $_REQUEST['Search_q'];
    // search in all table columns
    $query = "SELECT * FROM `artist` WHERE AND CONCAT(`id`, `name`, `email`, `country`, `state`, `city`, `explevel`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
}
 else {
    $query = "SELECT * FROM `artist`";
    $search_result = filterTable($query);
}
// function to connect and execute the query
function filterTable($query)
{
    include "../database/db.php";
    $filter_Result = mysqli_query($con, $query);
    return $filter_Result;

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
    <h3>All Artist</h3>
    <div class="search-box">
    <form action="artist-admin.php" method="REQUEST">
        <input type="text" name="Search_q" placeholder="Search Artist here" value="<?php if(isset($valueToSearch)){echo $valueToSearch;} ?>">
        <input type="submit" name="search" value="Search">
    </form>
    </div>
    <p class="msg"><?php if(isset($msg)){ echo $msg;}?></p>
<table>
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Address</th>
    <th>Exp. Level</th>
    <th>Approval</th>
    <th>Status</th>
    </tr>
<?php 
include "../database/db.php";
while ($con=mysqli_fetch_array($search_result)){
$id=$con['id'];
$name=$con['name'];
$email=$con['email'];
$mobile=$con['mobile'];
$country=$con['country'];
$state=$con['state'];
$city=$con['city'];
$explevel=$con['explevel'];
$approval=$con['approval'];
$ad=$con['ad'];
?>
    <tr>
        <td><?php echo $id;?></td>
        <td><?php echo $name;?></td>
        <td class="email"><?php echo $email;?></td>
        <td><?php echo $mobile;?></td>
        <td><?php echo $country; echo ','; echo $state; echo ','; echo $city;?></td>
        <td><?php echo $explevel;?></td>
        <td><?php
            if($approval==1){
                echo '<a class="btn approve" href="#">Approved</a>';
                
            }
            if($approval==0){
                echo '<a class="btn suspend" href="#">Not approved</a>'; 
            }
        ?></td>
        <td><?php
            if($ad==1){
                echo '<a class="btn approve" href="#">Activated<i class="fa fa-check" aria-hidden="true"></i></a>';
                
            }
            if($ad==0){
                echo '<a class="btn suspend" href="#">Deactivated<i class="fa fa-user-times" aria-hidden="true"></i></a>'; 
            }
        ?>
        </td>
        
    </tr>
<?php } ?>
</table>
</div>
</div>
</body>
</html>