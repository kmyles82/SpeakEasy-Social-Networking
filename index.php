
   <?php
      include('includes/header.php');
      // session_destroy();
      include('includes/classes/User.php');
      include('includes/classes/Post.php');

      if(isset($_POST['post'])){
            $post = new Post($con, $userLoggedIn);
            $post->submitPost($_POST['post_text'], 'none');
      }
   ?>
   
   <div class="card small z-depth-1">
         <div class="user_details column">
            <a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['profile_pic'] ?>" alt="user profile img" class="z-depth-1"></a>
            <div class="user_details_left_right">
                  <a href="<?php echo $userLoggedIn; ?>">
                  <?php
                        echo $user['first_name']." ".$user['last_name'];
                  ?>
                  </a>
                  <br>
                  <?php
                        echo "Post: ".$user['num_posts']."<br>";
                        echo "Bumps: ".$user['num_likes'];
                  ?>
            </div>
         </div>
   </div>

   <div class="card large main_column">
         <form action="index.php" method="post" class="post_form">
               <div class="input-field">
               <textarea name="post_text" id="post_text" class="z-depth-1" ></textarea>
               <label for="post_text">Got something to say?</label>
               </div>
               <input type="submit" name="post" id="post_button" class="btn waves-effect blue lighten-1" value="Post">
               <hr>
         </form>

      <?php
         $post = new Post($con, $userLoggedIn);
         $post->loadPostsFriends();
      ?>
   </div>
   
   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
