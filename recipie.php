<?php include 'webConfig.php';
 session_start();?>

 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
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
        if(isset($_GET['rec_id'])){
            $recipie = $_GET['rec_id'];
            $userId = $_SESSION['id'];

            $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
            if(!$conn){
                die("Connection Failed: " . mysqli_connect_error());
            }

             $sql = "SELECT u.username, r.title, r.calories, r.servings, r.directions, r.carbs, r.fat from user as u inner join recipie as r ON u.id = r.user_id where r.id = ".$recipie."";
             $results = mysqli_query($conn, $sql);
             $row = mysqli_fetch_assoc($results);
             echo "<h1> ".$row['title']."</h1><p> Made by: ".$row['username']."</p><p>Instructions: ".$row['directions']."</p>"; 
        }else{
            $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
            if(!$conn){
                die("Connection Failed: " . mysqli_connect_error());
            }

            echo"<h1>Discover</h1>";
            $sql = "SELECT u.username, r.title, r.calories, r.id FROM user as u inner join recipie as r ON u.id = r.user_id";

            $results = mysqli_query($conn, $sql);
            if(mysqli_num_rows($results) > 0){
                echo '<p style="display:flex; margin-top:50px; justify-content:center;">Recipes:</p>';
            while($row = mysqli_fetch_assoc($results)){
               // echo '<div style="margin-right:auto; margin-left:auto; margin-top:20px; justify-content:center; display:flex; width:fit-content; border: 1px solid black; background-color:grey" width:50%;><p style="margin-right:20px;">'.$row["username"].'</p><a style="margin-right:20px;" href="recipie.php?rec_id='.$row['id'].'">'.$row["title"].'</a><p>'.$row["calories"].'</p></div>';

                echo '<table style="margin-right:auto; margin-left:auto; margin-top:20px; border: 1px solid black; background-color:gainsboro;"><tr><th style="background-color: #4CAF50; color:white;">user</th><th style="background-color: #4CAF50; color:white;">recipe</th><th style="background-color: #4CAF50; color:white;">calories</th></tr><tr><td>'.$row["username"].'</td><td><a href="recipie.php?rec_id='.$row["id"].'">'.$row["title"].'</a></td><td>'.$row['calories'].'</td></tr></table>';
                  }
          
        }else{
            echo "No results.";
        }
        }
        

?>
    <div>
            <a href='createrecipe.php'>Create New Recipe</a>
    </div>
    <div>
            <a href='home.php'>Go To Search</a>
    </div>

</body>
</html>   

