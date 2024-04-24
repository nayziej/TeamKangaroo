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
        if(isset($_GET['dis_id'])){
            $discussion = $_GET['dis_id'];

            $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
            if(!$conn){
                die("Connection Failed: " . mysqli_connect_error());
            }

             $sql = "SELECT u.username, d.title FROM user as u INNER JOIN user_discussion as ud ON u.id = ud.user_id INNER JOIN discussion as d ON ud.discussion_id = d.id where ud.owner = 1 AND d.id = ".$discussion."";
             $results = mysqli_query($conn, $sql);
             $row = mysqli_fetch_assoc($results);
             echo "<h1> ".$row['title']."</h1><p style='bottom-margin:50px;'> Discussion Author: ".$row['username']."</p>";
            echo"<h2 style='display:flex; justify-content:center;'>Discussion Thread:</h2>";
            
            $sql = "SELECT p.title, u.username, p.content FROM post as p INNER JOIN user as u ON p.user_id = u.id WHERE disc_id = ".$discussion."";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0){
                while($r = mysqli_fetch_assoc($res)){
                    echo "<div class='disc'><p>".$r['title']."</p><p>".$r['username']."</p><p>".$r['content']."</p></div>";
                }
            }
            if(isset($_SESSION['username'])){
            echo"<p>Create a Post</p>";
            echo "<div class='new-post'><form class='np' name='make-post' method=post><div><label for='ptitle'>Title</label><input name='ptitle' type='text'></div><div><label for='pcontent'>Body</label><textarea name='pcontent' rows=4 cols=20></textarea></div><div><input name='submit' type='submit'></div></form></div>"; 

            if(isset($_POST['ptitle'])){
                $sql = "INSERT INTO post (title, user_id, content, disc_id) VALUES ('".$_POST['ptitle']."',".$_SESSION['id'].",'".$_POST['pcontent']."',".$discussion.")";
                mysqli_query($conn, $sql);
                $sql = "";
                header("Location: discussion.php?dis_id=".$discussion."");
                exit;
            }
            }
        }else{
            $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
            if(!$conn){
                die("Connection Failed: " . mysqli_connect_error());
            }

            echo"<h1>Discover</h1>";
            $sql = "SELECT u.username, d.title, d.id FROM user as u INNER JOIN user_discussion as ud ON u.id = ud.user_id INNER JOIN discussion as d ON ud.discussion_id = d.id where ud.owner = 1";

            $results = mysqli_query($conn, $sql);
            if(mysqli_num_rows($results) > 0){
                echo '<p style="display:flex; margin-top:50px; justify-content:center;">Discussions:</p>';
            while($row = mysqli_fetch_assoc($results)){
               // echo '<div style="margin-right:auto; margin-left:auto; margin-top:20px; justify-content:center; display:flex; width:fit-content; border: 1px solid black; background-color:grey" width:50%;><p style="margin-right:20px;">'.$row["username"].'</p><a style="margin-right:20px;" href="recipie.php?rec_id='.$row['id'].'">'.$row["title"].'</a><p>'.$row["calories"].'</p></div>';

                echo '<table style="margin-right:auto; margin-left:auto; margin-top:20px; border: 1px solid black; background-color:gainsboro;"><tr style="background-color: green;"><th>user</th><th>discussion</th></tr><tr><td>'.$row["username"].'</td><td><a href="discussion.php?dis_id='.$row["id"].'">'.$row["title"].'</a></td></tr></table>';
                  }

            echo "<a href='home.php'>Go To Search</a>";
        }else{
            echo "No results.";
        }
        }
        

?>


</body>
</html>
   
