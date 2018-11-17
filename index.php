
   <?php
      include('includes/header.php');
      // session_destroy();
      include('includes/classes/User.php');
      include('includes/classes/Post.php');

      if(isset($_POST['post'])){
            $post = new Post($con, $userLoggedIn);
            $post->submitPost($_POST['post_text'], 'none');
            header("Location: index.php");
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

      <div class="posts_area"></div>
      <img src="../../assets/images/icons/loading.gif" alt="" id="loading" style="width:32px">

   </div>
   
   <script>

      $(function(){
 
 var userLoggedIn = '<?php echo $userLoggedIn; ?>';
 var inProgress = false;
 loadPosts(); //Load first posts

 $(window).scroll(function() {
     var bottomElement = $(".status_post").last();
     var noMorePosts = $('.posts_area').find('.noMorePosts').val();

     // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
     if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
         loadPosts();
     }
 });

 function loadPosts() {
     if(inProgress) { //If it is already in the process of loading some posts, just return
         return;
     }
    
     inProgress = true;
     $('#loading').show();
     var page = $('.posts_area').find('.nextPage').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'

     $.ajax({

         url: "includes/handlers/ajax_load_posts.php",
         type: "POST",
         data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
         cache:false,
         success: function(response) {

             $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage
             $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage
             $('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage
             $('#loading').hide();
             $(".posts_area").append(response);
             inProgress = false;

         }

     });
 }

 //Check if the element is in view
 function isElementInView (el) {
       if(el == null) {
          return;
      }
     var rect = el.getBoundingClientRect();
     return (
         rect.top >= 0 &&
         rect.left >= 0 &&
         rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
         rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
     );
 }
});

      </script>

   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
