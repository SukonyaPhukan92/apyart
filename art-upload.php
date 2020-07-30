<?php session_start();
if(!isset($_SESSION["email"])){
    // echo "login done";
}
include "database/db.php";
include "artist-only.php";
?>
<?php 
$sql = "SELECT id FROM artist WHERE email = '" . $_SESSION['email'] . "' ";
$result = $con->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$artist_id=$row['id'];
?>
<?php
  // If upload button is clicked ... 
  if (isset($_POST['uploadart'])) { 

    $uploader = $artist_id;
    $title = $_POST['title'];
    $cat = $_POST['cat'];
    $tags = $_POST['tags'];
    $filename = $_FILES["uploadfile"]["name"]; 
    $tempname = $_FILES["uploadfile"]["tmp_name"];     
    $folder = "img/uploads/".$filename;
  
        // Get all the submitted data from the form 
        $sql = "INSERT INTO artwork (uploader, title, cat, tags, filename) VALUES ('$uploader', '$title', '$cat', '$tags', '$filename')"; 
  
        // Execute query 
        mysqli_query($con, $sql); 
          
        // Now let's move the uploaded image into the folder: image 
        if (move_uploaded_file($tempname, $folder))  {
            $msg ="Artwork sucessfuly uploaded";
            echo "<script type='text/javascript'>window.location='upload.php?msg=".$msg."';</script> ";
        }else{ 
            $msg ="Something went wrong";
            echo "<script type='text/javascript'>window.location='upload.php?msg=".$msg."';</script> ";
      } 
  } 
  
?>