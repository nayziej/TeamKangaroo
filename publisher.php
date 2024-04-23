<?php include 'webConfig.php';?>
    <!DOCTYPE html>
    <html lang="en">
 
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Publishers</title>
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
         </div>
<?php
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT name, username FROM user";
$result = mysqli_query($conn, $sql);


    echo "<table class='publisher-list'>";
    echo "<tr><th>Name</th><th>Profile</th></tr>"; // Table headers
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>"; // Display name
        echo "<td><a href='profile.php?user=" . urlencode($row["username"]) . "'>" . htmlspecialchars($row["username"]) . "</a></td>"; // Display link to profile
        echo "</tr>";
    }
    echo "</table>";
mysqli_close($conn);
?>
