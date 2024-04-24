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

        if(isset($_GET['pid'])){
        $_SESSION['pid'] = $_GET['pid'];
        $_SESSION['dis_id'] = $_GET['dis_id'];
        echo "<h1 style='display:flex; justify-content:center;'>Current Post</h1>";
        $sql = "SELECT p.title, u.username, p.content FROM post as p INNER JOIN user as u ON p.user_id = u.id WHERE p.id = ".$_GET['pid']."";

        
        $results = mysqli_query($conn, $sql);
        if(mysqli_num_rows($results) > 0){
            while($r = mysqli_fetch_assoc($results)){
                echo "<div class='disc'><p>".$r['title']."</p><p>".$r['username']."    </p><p>".$r['content']."</p></div>";
            }
        }
            echo "<h1 style='display:flex; justify-content: center;'>You are about to delete this post</h1>";
        echo "<div style='display:flex; justify-content: center;'><form method=post><label for='delete'>Delete?</label><input name='delete' type='submit'></form></div>";
            
        
        
        echo "<a href='discussion.php?dis_id=".$_GET['dis_id']."'>Back to discussion</a>";
}
        if(isset($_POST['delete'])){

            echo"<p>here</p>";
           $sql = "DELETE FROM post WHERE id = ".$_SESSION['pid']." AND user_id =".$_SESSION['id'].""; 

            mysqli_query($conn, $sql);
            header("Location: discussion.php?dis_id=".$_SESSION['dis_id']."");
            exit;
        }

?>



</body>
</html>
