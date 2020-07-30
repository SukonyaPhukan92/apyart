<?php 
        $email=$_SESSION['email'];
        $check=mysqli_query($con,"SELECT email from artist where email='$email'");
        $checkrows=mysqli_num_rows($check);

        if($checkrows<1) {
            echo "<script type='text/javascript'>window.location='profile-complete.php';</script> ";
          } else {
            echo "";
          }
?>