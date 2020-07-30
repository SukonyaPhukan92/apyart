<?php
session_start();

include('database/db.php');

$user_id = $_SESSION['login_user'];
$artwork_id = htmlentities($_POST["artwork_id"]);
$created_at = $date = date("Y-m-d H:i:s");


if(isset($_SESSION['login_user'])){

	$check_artwork = mysqli_query($con, "SELECT * FROM artwork WHERE id = ".$artwork_id);

	if (mysqli_num_rows($check_artwork) != 0) {

		$check_my_likes = mysqli_query($con, "SELECT * FROM likes WHERE artwork_id = ".$artwork_id." AND user_id = ".$user_id);
		$check_likes = mysqli_query($con, "SELECT * FROM likes WHERE artwork_id = ".$artwork_id);

		if (mysqli_num_rows($check_my_likes) == 0) {
			$sql = "INSERT INTO likes (user_id, artwork_id, created_at) VALUES ('".$user_id."', '".$artwork_id."', '".$created_at."')";
			if ($con->query($sql) === TRUE) {
				$like_counter = mysqli_num_rows($check_likes)+1;
			  echo "
			  		<a class='card-link' title='Liked'><i class='fa fa-heart' aria-hidden='true'></i></a>
			  		<script>
			  			document.getElementById('like_counter_".$artwork_id."').innerHTML=".$like_counter.";
			  		</script>
			  		";
			} else {
			  echo "Error: " . $sql . "<br>" . $con->error;
			}
			
		}else{
			echo "Already Liked.";
		}
	}else{
		echo "Artwork does not exist.";
	}

	$con->close();
}