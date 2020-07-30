<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Error 404 - Page not found</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-2.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include "includes/nav.php"?>
<main class="error">
  <div class="box">
  <img src="img/error.png" alt="error"><br>
    <h3>Error 404 Not found</h3>
      <div>
      <a href="index.php" class="home-btn" >go to home</a>
      </div>
    </div>
  </main>

  <?php include "includes/footer.php"?>
</body>
</html>