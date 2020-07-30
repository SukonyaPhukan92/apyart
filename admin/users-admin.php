<?php
include "admin-auth.php";
if(isset($_REQUEST['msg'])){
    $msg = $_REQUEST['msg'];
}
if(isset($_REQUEST['search']))
{
    $valueToSearch = $_REQUEST['Search_q'];
    // search in all table columns
    $query = "SELECT * FROM `users` WHERE CONCAT(`id`, `name`, `email`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
}
 else {
    $query = "SELECT * FROM `users`";
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
<h3>Users <i class="fa fa-user-o btn approve" aria-hidden="true"></i></h3>
<div class="search-box">
    <form action="users-admin.php" method="REQUEST">
        <input type="text" name="Search_q" placeholder="Search Users here" value="<?php if(isset($valueToSearch)){echo $valueToSearch;} ?>">
        <input type="submit" name="search" value="Search">
    </form>
</div>
    <p class="msg"><?php if(isset($msg)){ echo $msg;}?></p>
<table>
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Reg Date</th>
    <th>Action</th>
    </tr>
<?php 
include "../database/db.php";
while ($con=mysqli_fetch_array($search_result)){
$id=$con['id'];
$name=$con['name'];
$email=$con['email'];
$reg_date=$con['reg_date'];
$status=$con['status'];
?>
    <tr>
        <td><?php echo $id;?></td>
        <td><?php echo $name;?></td>
        <td class="email"><?php echo $email;?></td>
        <td><?php echo $reg_date;?></td>
        <td>
            <?php
            if($status==1){
                echo '<a class="btn suspend" href="user-deactivate-admin.php?id='.$id.'"><i class="fa fa-user-times" aria-hidden="true"></i></a>';
            }
            if($status==0){
                echo '<a class="btn approve" href="user-reactivate-admin.php?id='.$id.'"><i class="fa fa-check" aria-hidden="true"></i></a>';
            }
            ?>
            <a class="btn delete" href="user-delete-admin.php?email=<?php echo $email;?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
        </td>
    </tr>
<?php } ?>
</table>



















</div>










</div>
</body>
</html>