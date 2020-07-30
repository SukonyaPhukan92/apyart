<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApyArt - Free stock images and illustartion</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php include "includes/nav.php" ?>
    <header>
      <section>
          <h2>ApyArt</h2>
          <p>The internet’s source of freely-usable images. <br>Powered by creators everywhere.</p>
          <form action="artwork.php" method="Request">
          <input type="text" name="Search_q" placeholder="Search images, arts , category and many more..."/>
          <input type="submit" name="search" value="Search">
          </form>
      </section>
    </header>
<div class="rowa" >
        <div class="columna">
          <h2>What ApyArt is?</h2>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium fugit repudiandae vero ullam voluptatibus nesciunt nostrum eos optio delectus commodi ducimus incidunt tempora nam, doloremque fuga voluptatum. Praesentium, doloremque iste!</p>
          <h4>Do you want to publish your artwork?</h4>
          <a href="register.php" class="join-btn">Join with us</a>
        </div>
        <div class="columna">
          <img src="img/about-collage.jpg" alt="collage">
        </div>
</div>


<div class="cards">
  <input type="hidden" name="post_scroll_old_pagination" id="post_scroll_old_pagination" value="9">
  <input type="hidden" name="post_scroll_new_pagination" id="post_scroll_new_pagination" value="18">
<?php 
require "database/db.php";


if(isset($_SESSION['login_user'])){
  $user_id = $_SESSION['login_user'];
}else{
  $user_id = '';
}

$get2 = mysqli_query($con,"SELECT id, filename, uploader,views FROM artwork WHERE ad = 1 order by id ASC,views DESC");
$totaldata = mysqli_num_rows($get2);
$get = mysqli_query($con,"SELECT id, filename, uploader,views FROM artwork WHERE ad = 1 order by id ASC,views DESC Limit 0,9");
while ($row = mysqli_fetch_array($get)) {
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
    
?>
<input type="hidden" name="finaldata" id="finaldata" value="<?php echo $finaldata; ?>">
</div>
<div class="ajax-loader" style="display: none;text-align: center;">
    <img src="img/loader.gif" width="20"> Loading more posts...
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.1.0/dist/lazyload.min.js"></script>
<script src="js/lazy-load-img.js"></script>
<script src="js/script.js"></script>
<script>
  function scrolldata(type){
      if(type == "mobile"){
          $(window).on("scroll", function(e){

            if($(window).scrollTop() + $(window).height() < $(document).height() - 100) {
                  var post_scroll_old_pagination = $("#post_scroll_old_pagination").val();
                  var post_scroll_new_pagination = $("#post_scroll_new_pagination").val();
                    $(".ajax-loader").show();
                    $.ajax({
                        url: "ajax/get_new_artwork.php",
                        type: "POST",
                        datatype: "json",
                        async: false,
                        data: "post_scroll_old_pagination=" + post_scroll_old_pagination + "&post_scroll_new_pagination=" + post_scroll_new_pagination,
                        success: function(result) {
                            if (result != "@@@@@") {
                                post_scroll_new_pagination = parseInt(post_scroll_new_pagination) + parseInt(9);
                                post_scroll_old_pagination = post_scroll_new_pagination - 9;
                                $("#post_scroll_old_pagination").val(post_scroll_old_pagination);
                                $("#post_scroll_new_pagination").val(post_scroll_new_pagination);
                                $(".cards").append(result);
                                $(".ajax-loader").hide();
                                const myLazyLoad = new LazyLoad({
                      elements_selector: ".photo"
                    });
                            }else{
                              $(".ajax-loader").show();
                              $(".ajax-loader").html("<div>No More Data Found.</div>");
                            }
                            
                        }
                    });
                    return false;
                  
            }
        });
      }else{
        $(window).on("scroll", function(e){

            if($(window).scrollTop() + $(window).height() == $(document).height()) {
                  var post_scroll_old_pagination = $("#post_scroll_old_pagination").val();
                  var post_scroll_new_pagination = $("#post_scroll_new_pagination").val();
                    $(".ajax-loader").show();
                    $.ajax({
                        url: "ajax/get_new_artwork.php",
                        type: "POST",
                        datatype: "json",
                        async: false,
                        data: "post_scroll_old_pagination=" + post_scroll_old_pagination + "&post_scroll_new_pagination=" + post_scroll_new_pagination,
                        success: function(result) {
                            if (result != "@@@@@") {
                                post_scroll_new_pagination = parseInt(post_scroll_new_pagination) + parseInt(9);
                                post_scroll_old_pagination = post_scroll_new_pagination - 9;
                                $("#post_scroll_old_pagination").val(post_scroll_old_pagination);
                                $("#post_scroll_new_pagination").val(post_scroll_new_pagination);
                                $(".cards").append(result);
                                $(".ajax-loader").hide();
                                const myLazyLoad = new LazyLoad({
                      elements_selector: ".photo"
                    });
                            }else{
                              $(".ajax-loader").show();
                              $(".ajax-loader").html("<div>No More Artwork Found.</div>");
                            }
                            
                        }
                    });
                    return false;
                  
            }
        });
      }
  }
  $(document).ready(function(){
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
             scrolldata("mobile");
        }else{
             scrolldata("desktop");
        }
  });
</script>
</body>
</html>