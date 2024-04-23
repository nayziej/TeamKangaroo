<?php include 'webConfig.php';?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussions</title>
    <link rel="stylesheet" href="home.css" />
</head>

<body>
    <div class=navbar-wrapper>
        <a href="home.php" class="logo">reciPIES</a>
 
        <div class="navbar">
            <a href="home.php">Home</a>
            <a href="publisher.php">Publishers</a>
            <a href="discussion.php">Discussions</a>
            <a href="recipie.php">Recipies</a>
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
             echo "<h1> ".$row['title']."</h1><p style='bottom-margin:50px;'> Made by: ".$row['username']."</p>";
            
            
            $sql = "SELECT title, user_id, content FROM post WHERE disc_id = ".$discussion."";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0){
                while($r = mysqli_fetch_assoc($res)){
                    echo "<div><p>".$r['title']."</p><p>".$r['user_id']."</p><p>".$r['content']."</p></div>";
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

                echo '<table style="margin-right:auto; margin-left:auto; margin-top:20px; border: 1px solid black; background-color:grey;"><tr><th>user</th><th>discussion</th></tr><tr><td>'.$row["username"].'</td><td><a href="discussion.php?dis_id='.$row["id"].'">'.$row["title"].'</a></td></tr></table>';
                  }

            echo "<a href='home.php'>Go To Search</a>";
        }else{
            echo "No results.";
        }
        }
        

?>


</body>
</html>
   
