<?php session_start();
if(!isset($_SESSION["email"])){
    // echo "login done";
}
include "database/db.php";
?>
<?php 
$sql = "SELECT * FROM users WHERE email = '" . $_SESSION['email'] . "' ";

$result = $con->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$name=$row['name'];
?>
<?php
    // If form submitted, insert values into the database.
    require('database/db.php');
    if (isset($_POST['mobile'])){
		$mobile = stripslashes($_POST['mobile']); // removes backslashes
        $mobile = mysqli_real_escape_string($con,$mobile); //escapes special characters in a string
        $email =$_SESSION['email'];
        
		$country = stripslashes($_POST['country']);
        $country = mysqli_real_escape_string($con,$country);
        $state = stripslashes($_POST['state']);
        $state = mysqli_real_escape_string($con,$state);
        $city = stripslashes($_POST['city']);
        $city = mysqli_real_escape_string($con,$city);

        $storelocation = stripslashes($_POST['storelocation']);
        $storelocation = mysqli_real_escape_string($con,$storelocation);

        $explevel = stripslashes($_POST['explevel']);
        $explevel = mysqli_real_escape_string($con,$explevel);

        $check=mysqli_query($con,"SELECT email from artist where email='$email'");
        $checkrows=mysqli_num_rows($check);

        if($checkrows>0) {
             $msg = 'You have already completed profile';
          } else { 
            
        $socialmediaquery="INSERT into `socialmedia` (email) VALUES ('$email')";
        $socialresult = mysqli_query($con,$socialmediaquery);
        if($socialresult){
            // echo "done";
        }
        $query = "INSERT into `artist` (name, email, mobile, country, state, city, storelocation, explevel) VALUES ('$name','$email', '$mobile', '$country', '$state', '$city', '$storelocation', '$explevel')";
        $result = mysqli_query($con,$query);
        
        if($result){
            echo "<script type='text/javascript'>window.location='profile.php';</script> ";
        }
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body, html{
            height: 100%;
        }
        header{
            height:700px;
        }
        @media(max-width:800px){
            header{
                background-position: center;
                background-size: cover;
                height: 100%;
            }
        }
        
    </style>
</head>
<body>
<?php include "includes/nav.php" ?>
    <header>
    
        <div class="login-form">
            <p class="login-text">Complete Profile</p>
            <form action="" method="POST">
            <p class="form-error-msg"><?php if(isset($msg)){echo $msg;} ?></p>
            <!-- <label for="input-label">Mobile</label> -->
            <input type="number" name="mobile" placeholder="Mobile (optional)">

            <!-- <label for="input-label">Location</label> -->
            <div class="geo-select">
            <select name="country" class="countries" id="countryId" required>
            <option value="">Country</option>
            </select>

            <select name="state" class="states" id="stateId" required>
            <option value="">State</option>
            </select>

            <select name="city" class="cities" id="cityId" required>
            <option value="">City</option>
            </select>
            </div>
            <!-- <label for="input-label">Store Location</label> -->
            <input type="text" name="storelocation" placeholder="Store Location (optional)">

            <!-- <label for="input-label">Artist Type</label> -->
            <select name="explevel">
            <option value="">Artist Level (optional)</option>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Expert">Expert</option>
            </select><br>
            <br>
            <input type="submit" value="Complete">
            </form>
        </div>
    </header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/location.js"></script>
</body>
</html>