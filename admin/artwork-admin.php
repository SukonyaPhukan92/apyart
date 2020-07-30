<?php
include "admin-auth.php";
if(isset($_REQUEST['msg'])){
    $msg = $_REQUEST['msg'];
}
if(isset($_REQUEST['search']))
{
    $valueToSearch = $_REQUEST['Search_q'];
    // search in all table columns
    $query = "SELECT * FROM `artwork` WHERE CONCAT(`id`, `filename`) LIKE '%".$valueToSearch."%' ORDER by id DESC";
    $search_result = filterTable($query);
}else{
    $query = "SELECT * FROM `artwork` ORDER by id DESC";
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
<h3>Artworks <i class="fa fa-user-o btn approve" aria-hidden="true"></i></h3>
<div class="search-box">
    <form action="artwork-admin.php" method="REQUEST">
        <input type="text" name="Search_q" placeholder="Enter Artwork ID" value="<?php if(isset($valueToSearch)){echo $valueToSearch;} ?>">
        <input type="submit" name="search" value="Search">
    </form>
    </div>
    <p class="msg"><?php if(isset($msg)){ echo $msg;}?></p>
<table>
    <tr>
    <th>ID</th>
    <th>Arwork</th>
    <th>Action</th>
    </tr>
<?php 
include "../database/db.php";
while ($con=mysqli_fetch_array($search_result)){
$id=$con['id'];
$filename=$con['filename'];
?>
    <tr>
        <td><?php echo $id;?></td>
        <td><a href="../artist-artwork.php?id=<?php echo $id;?>"><img class="artwork" src="../img/uploads/<?php echo $filename;?>"></a></td>
        <td><a class="btn delete" href="delete-artwork-admin.php?id=<?php echo $id;?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
    </tr>
<?php } ?>
</table>



















</div>










</div>
</body>
</html>