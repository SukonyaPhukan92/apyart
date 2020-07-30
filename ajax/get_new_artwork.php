<?php 
    include("../database/db.php");

    $post_scroll_old_pagination = $_POST['post_scroll_old_pagination'];
    $post_scroll_new_pagination = $_POST['post_scroll_new_pagination'];

    if(isset($_SESSION['login_user'])){
  $user_id = $_SESSION['login_user'];
}else{
  $user_id = '';
}
?>
<?php
      $get = mysqli_query($con,"SELECT id, filename, uploader,views FROM artwork WHERE ad = 1 order by id ASC,views DESC Limit $post_scroll_old_pagination,$post_scroll_new_pagination");
    
      if(mysqli_num_rows($get)>0){
          while($row = mysqli_fetch_array($get)){
              $art_id =$row['id'];
    $uploader = $row['uploader'];
    $filename = $row['filename'];
    echo "<div class='card'><a href='artist-artwork.php?id=".$art_id."'><img src='img/placeholder.png' class='photo' data-src='img/uploads/".$filename."'></a>";
    ?>
    <br>
      <div class="card-like-comments">
          <?php
          // Count all likes and comments against this Artwork
          $likes_count = mysqli_query($con, "SELECT * FROM likes WHERE artwork_id = ".$row['id']);
          $comments_count = mysqli_query($con, "SELECT * FROM comments WHERE artwork_id = ".$row['id']);
          
          // Check logged in user's likes
          $check_my_like = mysqli_query($con, "SELECT * FROM likes WHERE artwork_id = ".$row['id']." AND user_id = ".$user_id);
          if(isset($_SESSION['email'])){
            if(mysqli_num_rows($check_my_like) == 0){
            ?>
              <span id="like_id_<?php echo $row['id'] ?>">
                <a onclick="Like('<?php echo $row['id'] ?>')" class="card-link"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
            </span>
          <?php }else{ ?>
              <a class="card-link" title="Liked"><i class="fa fa-heart" aria-hidden="true"></i></a>
            <?php } ?>  
        <?php }else{ ?> 
          <b><a href="login.php" class='card-link'><i class="fa fa-heart-o" aria-hidden="true"></i></a></b>
        <?php } ?>  
          · <span id="like_counter_<?php echo $row['id'] ?>"><?php echo mysqli_num_rows($likes_count); ?></span>

          &nbsp;&nbsp;&nbsp;

        <?php if(isset($_SESSION['email'])){ ?>
          <a onclick="document.getElementById('comment_input_<?php echo $row['id'] ?>').focus()" class="card-link"><i class="fa fa-comment-o" aria-hidden="true"></i></a> 
        <?php }else{ ?>
          <b><a href="login.php" class='card-link'><i class="fa fa-comment-o" aria-hidden="true"></i></a></b>
        <?php } ?>
          · <span id="comment_counter_<?php echo $row['id'] ?>"><?php echo mysqli_num_rows($comments_count); ?></span>
      </div>
       
    <?php
    echo "</div>";
    }
  }else{  echo "@@@@@"; 

      } 
?>