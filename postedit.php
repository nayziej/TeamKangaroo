<?php include 'webConfig.php';
session_start();
;?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussions</title>
    <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>" />
</head>

<body>
    <div class=navbar-wrapper>
      <img src="images/recipies1.png" alt="reciPIES Logo" style=style= height: 400px; width: 400px>
 
        <div class="navbar">
            <a href="home.php">Home</a>
            <a href="publisher.php">Publishers</a>
            <a href="discussion.php">Discussions</a>
            <a href="recipie.php">Recipes</a>
            <a href="profile.php">Profile</a>
        </div>
        <div class="ls-buttons">
            <form style="float:left;" action="login.php">
                <button class="btn" type="submit" href="login.php">Log In</button>
            </form>
            <form style="float: left;" action="signup.php">
                <button class="btn" type="submit" href="signup.php">Sign Up</button>
            </form>
        </div>
    </div>


    
    <?php
        $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
        if(!$conn){
            die("Connection Failed: " . mysqli_connect_error());
        }
        echo "<h1 style='display:flex; justify-content:center;'>Current Post</h1>";
        $sql = "SELECT p.title, u.username, p.content FROM post as p INNER JOIN user as u ON p.user_id = u.id WHERE p.id = " . $_GET['pid']."";
        $results = mysqli_query($conn, $sql);
        if(mysqli_num_rows($results) > 0){
            while($r = mysqli_fetch_assoc($results)){
                echo "<div class='disc'><p>".$r['title']."</p><p>".$r['username']."    </p><p>".$r['content']."</p></div>";
            }
        }
            echo "<h1 style='display:flex; justify-content: center;'>Edited Post</h1>";
            echo "<p style='display:flex; justify-content: center;'> Note you will need to refiil both fields again.</p>";
        echo "<div class='edit-post'><form class='np' name='make-post' method=post><div><label for='ptitle'>Title</label><input name='ptitle' type='text'></div><div><label for='pcontent'>Body</label><textarea name='pcontent' rows=4 cols=20></textarea></div><div><input name='submit' type='submit'></div></form></div>";
        
        echo "<a href='discussion.php?dis_id=".$_GET['dis_id']."'>Back to discussion</a>";

        if(isset($_POST['ptitle'])){
           $sql = "UPDATE post SET title='" .$_POST['ptitle']."', content='" .$_POST['pcontent']."' WHERE id = " .$_GET['pid']."";

            mysqli_query($conn, $sql);
            header("Location: discussion.php?dis_id=".$_GET['dis_id']."");
            exit;
        }

?>



</body>
</html>
