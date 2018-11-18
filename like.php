

<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">
        <style>
            *{
                font-size: 12px;
                font-family: Arial, Helvetica, sans-serif;
            }

            body{
                background: #fff;
            }

            form{
                position: absolute;
                top: 0;
            }
        </style>
    </head>
    <body>
    <?php
    require'config/config.php';
    include('includes/classes/User.php');
    include('includes/classes/Post.php');
    include('includes/classes/Notification.php');

    if(isset($_SESSION['username'])){
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE  username='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
    } else {
        header("Location: register.php");
    }

        //get id of post
        if(isset($_GET['post_id'])){
            $post_id = $_GET['post_id'];
        }

        $get_likes = mysqli_query($con, "SELECT likes, added_by FROM posts WHERE id='$post_id'");
        $row = mysqli_fetch_array($get_likes);
        $total_likes = $row['likes'];
        $user_liked = $row['added_by'];

        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user_liked'");
        $row = mysqli_fetch_array($user_details_query);
        $total_user_likes = $row['num_likes'];
        

        

        //like button
        if(isset($_POST['like_button'])){
            $total_likes++;
            $query = mysqli_query($con, "UPDATE post SET likes='$total_likes' WHERE id='$post_id'");
            $total_user_likes++;
            $user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
            $insert_user = mysqli_query($con, "INSERT INTO likes VALUES('','$userLoggedIn','$post_id')");

            //insert notification
        }

        //unlike button
        if(isset($_POST['unlike_button'])){
            $total_likes--;
            $query = mysqli_query($con, "UPDATE post SET likes='$total_likes' WHERE id='$post_id'");
            $total_user_likes--;
            $user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
            $insert_user = mysqli_query($con, "DELETE FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
        }

        //check for previous likes
        $check_query = mysqli_query($con, "SELECT * FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
        $num_rows = mysqli_num_rows($check_query);

        if($num_rows > 0){
            echo '<form action="like.php?post_id='.$post_id.'" method="post">
                    <input type="submit" class="comment_like btn waves-effect" name="unlike_button" value="Unlike">
                    <div class="like_value">
                        '.$total_likes.' Likes
                    </div>
                  </form>
            ';

        } else {
            echo '<form action="like.php?post_id='.$post_id.'" method="post">
                    <input type="submit" class="comment_like btn waves-effect" name="like_button" value="Like">
                    <div class="like_value">
                        '.$total_likes.' Likes
                    </div>
                  </form>
            ';
        }

        ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>