<?php include 'webConfig.php';?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css" />
</head>

<body>
    <div class=navbar-wrapper>
        <a href="home.php" class="logo">Title</a>
 
        <div class="navbar">
            <a href="home.php">Home</a>
            <a href="">Publishers</a>
            <a href="recipie.php">Recipies</a>
            <a href="">Profile</a>
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

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if(!$conn){
                die("Connection Failed: " . mysqli_connect_error());
            }

             $sql = "SELECT u.username, r.title, r.calories, r.servings, r.directions, r.carbs, r.fat from user as u inner join recipie as r ON u.id = r.user_id where r.id = ".$recipie."";
             $results = mysqli_query($conn, $sql);
             $row = mysqli_fetch_assoc($results);
             echo "<p> ".$row['title']."</p><p>".$row['username']."</p><p>".$row['directions']."</p>"; 
        }else{
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if(!$conn){
                die("Connection Failed: " . mysqli_connect_error());
            }

            echo"<h1>Discover</h1>";
            $sql = "SELECT u.username, r.title, r.calories, r.id FROM user as u inner join recipie as r ON u.id = r.user_id";

            $results = mysqli_query($conn, $sql);
            if(mysqli_num_rows($results) > 0){
                echo '<p style="display:flex; margin-top:50px; justify-content:center;">Recipies:</p>';
            while($row = mysqli_fetch_assoc($results)){
                echo '<div style="margin-right:auto; margin-left:auto; margin-top:20px; justify-content:center; display:flex; width:fit-content; border: 1px solid black; background-color:grey" width:50%;><p style="margin-right:20px;">'.$row["username"].'</p><a style="margin-right:20px;" href="recipie.php?rec_id='.$row['id'].'">'.$row["title"].'</a><p>'.$row["calories"].'</p></div>';
                  }

            echo "<a href='home.php'>Go To Search</a>";
        }else{
            echo "No results.";
        }
        }
        

?>


</body>
</html>
   

