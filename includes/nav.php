<nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn"><i class="fa fa-bars"></i></label>
        <label class="logo">ApyArt</label>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="artwork.php">Artwork</a></li>
          <li><a href="artist.php">Artist</a></li>
          <li><a href="collection.php">Collection</a></li>
          <li><a href="about.php">About us</a></li>
          <li><a href="contact.php">Contact us</a></li>
          
    
          
          <?php
          include "./database/db.php";
          if( isset($_SESSION['email']) )
          {
            $sql = "SELECT profilepic FROM users  WHERE email = '" . $_SESSION['email'] . "' ";
            $result = $con->query($sql);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $profilepic=$row['profilepic'];
            echo "<li><a href='upload.php'>Upload</a></li>";
            echo "<button class='profile-pic-btn-box'><a href='profile.php'><img src='$profilepic' class='profile-img-nav'/></button></a>";  
            echo "<li><a href='logout.php'>Logout</a></li>";
          }
          else{
            echo "<li><a href='login.php' class='login-btn'>Login</a></li>";
            echo "<li><a href='register.php' class='join-btn'>Register</a></li>";
          }
?>  

</ul>
</nav>

