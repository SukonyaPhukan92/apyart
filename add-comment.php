<?php
session_start();

include('database/db.php');

$user_id = $_SESSION['login_user'];
$artwork_id = htmlentities($_POST["artwork_id"]);
$comment = mysqli_real_escape_string($con, $_POST["comment"]);
$created_at = $date = date("Y-m-d H:i:s");


$check_artwork = mysqli_query($con, "SELECT * FROM artwork WHERE id = ".$artwork_id);
$check_comments = mysqli_query($con, "SELECT * FROM comments WHERE artwork_id = ".$artwork_id);

if(isset($_SESSION['login_user'])){

	if (mysqli_num_rows($check_artwork) != 0) {
		$sql = "INSERT INTO comments (user_id, artwork_id, comment, created_at) VALUES ('".$user_id."', '".$artwork_id."', '".$comment."', '".$created_at."')";
		if ($con->query($sql) === TRUE) {
		   $comment_counter = mysqli_num_rows($check_comments)+1;
		  	echo '
		  		<li class="list-group-item">'.$_POST["comment"].' <br> <small>('.date("Y M, d · h:i a", strtotime($created_at)).')</small></li>
		  		<script>
		  			document.getElementById("comment_counter_'.$artwork_id.'").innerHTML='.$comment_counter.';
		  		</script>
		  	';
		} else {
		  echo "Error: " . $sql . "<br>" . $con->error;
		}
	}else{
		echo "Artwork does not exist.";
	}

	$con->close();
}