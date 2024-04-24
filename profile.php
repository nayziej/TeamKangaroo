<?php include 'webConfig.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
            <form  style="float:left;"action="login.php">
            <button class="btn" type="submit" href="login.php">Log In</button>
            </form>
            <form  style="float: left;"action="signup.php">
            <button class="btn" type="submit" href="signup.php">Sign Up</button>
            </form>
        </div>
        <?php if (isset($_SESSION['message'])): ?>
        <p style="color: green;"><?= $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?= $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); endif; ?>
    </div>
    <?php

    if(isset($_GET['user'])){
        echo "<h1 class='p-username'>".$_GET['user']."'s Profile</h1>";
        echo "<h2>Recipes:</h2>";

        $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
        if (!$conn){
            die("Connection failed: ". mysqli_connect_error());
        }

        $sql = "SELECT r.id, r.title, r.calories FROM recipie as r INNER JOIN user as u ON r.user_id = u.id WHERE u.username = '".$_GET['user']."'";
        $results = mysqli_query($conn, $sql);
        if(mysqli_num_rows($results) > 0){
            while($row = mysqli_fetch_assoc($results)){
                echo '<table style="margin-right:auto; margin-left:auto; margin-top:20px; border: 1px solid black; background-color:gainsboro;"><tr><th style="background-color: #4CAF50; color:white;">recipe</th><th style="background-color: #4CAF50; color: white;">calories</th></tr><tr><td><a href="recipie.php?rec_id='.$row["id"].'">'.$row["title"].'</a></td><td>'.$row['calories'].'</td></tr></table>';
            }
        }else{
            echo "<p>User does not have any recipes yet.</p>";
        }
    }elseif(isset($_SESSION['username'])){
        echo"<h1 class='p-username1'>".$_SESSION['username']."'s Profile</h1>";
        echo "<h2>Recipes:</h2>";

        $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
        if(!$conn){
            die("Connection failed: ".mysqli_connect_error());
        }

        $sql = "SELECT r.id, r.title, r.calories FROM recipie as r INNER JOIN user as u     ON r.user_id = u.id WHERE u.username = '".$_SESSION['username']."'";
        $results = mysqli_query($conn, $sql);
        if(mysqli_num_rows($results) > 0){
                       echo '<table style="margin-right:auto; margin-left:auto; margin-top:20px; border: 1px solid black; background-color:grey;">';
            echo '<tr><th>Recipe</th><th>Calories</th><th>Actions</th></tr>';
            while($row = mysqli_fetch_assoc($results)){
<<<<<<< HEAD
                echo '<tr><td><a href="recipie.php?rec_id='.$row["id"].'">'.$row["title"].'</a></td>';
                echo '<td>'.$row['calories'].'</td>';
                echo '<td><a href="editrecipe.php?rec_id='.$row["id"].'">Edit</a> | <a href="deleterecipe.php?rec_id='.$row["id"].'">Delete</a></td></tr>';
=======
             echo ' <table style="margin-right:auto; margin-left:auto; margin-top:20px; border: 1px solid black; background-color:gainsboro;"><tr><th style="background-color: #4CAF50; color:white;">recipe</th><th style="background-color: #4CAF50; color:white;">calories</th></tr><tr><td>'.'</td><td><a href="recipie.php?rec_id='.$row["id"].'">'.$row["title"].'</a></td><td>'.$row['calories'].'</td></tr></table>';
>>>>>>> 3f19e782a0dbce0aba39dc43ffd8f7d2fee79fed
            }
            echo '</table>';
            
        }else{
            echo "<p>User does not have any recipes yet.";
        }
    }else{
        echo "<p>Please login or signup to view profile.</p>";
    }
?>
    <footer>
        <a href="logout.php" class="logout-link">Logout</a>
    </footer>
</body>
</html>
<?php

