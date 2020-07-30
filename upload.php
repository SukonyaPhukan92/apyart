<?php
session_start();
if(!isset($_SESSION["email"])){
  echo "<script type='text/javascript'>window.location='login.php';</script> ";
}
include "database/db.php";
include "artist-only.php";
$msg = $_REQUEST['msg'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Art | ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-2.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php include "includes/nav.php" ?>

    <div class="page-header">
    </div>
<p class="sucess-form-msg artwork"><?php if(isset($msg)){echo $msg;}?></p>
    <div class="upload-section">
        <p>add title</p>
        <form method="POST" action="art-upload.php" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <p>category</p>
        <select name="cat" required>
          <option value="">Select Category</option>
          <option value="Portrait">Portrait</option>
          <option value="Landscape">Landscape</option>
          <option value="Abstract">Abstract</option>
          <option value="Still life">Still Life</option>
          <option value="Doodle">Doodle</option>
          <option value="Mandala">Mandala</option>
          <option value="Digital painting">Digital Painting</option>
          <option value="Animation">Animation</option>
          <option value="Vector art">Vector Art</option>
          <option value="Quote">Quote</option>
          <option value="Tech">Tech</option>
          <option value="Craft">Craft</option>
        </select>
        <p>search tags <i class="fa fa-info-circle" aria-hidden="true" onclick="showmoreInfo()"></i></p>
        <p id="moreInfo">Search tag should be releted to your your artwork. This will help in searching of artworks and SEO.</p>
        <input type="text" name="tags" placeholder="Search tags separated by spaces" required>
        
        <div class="art-upload">
        <input type="file" name="uploadfile" accept="image/*" onchange="loadFile(event)" class="upload" required>
            <span>Select Art <i class="fa fa-cloud-upload btn-icon" aria-hidden="true"></i></span>
        </div>
       <img id="output" class="image-preview">
       <div class="art-upload-btn">
       <input type="submit" name="uploadart" value="SUBMIT">
       </form>
       </div>
    </div>
<script src="js/image-preview.js"></script>
<script src="js/dropdown.js"></script>
<script>
  function showmoreInfo() {
   document.getElementById('moreInfo').style.display = "block";
}
</script>
</body>
</html>