<?php include 'webConfig.php';?>
    <!DOCTYPE html>
    <html lang="en">
 
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Publishers</title>
         <link rel="stylesheet" href="home.css" />
    </head>

    <body>
        <div class=navbar-wrapper>
             <a href="home.php" class="logo">Title</a>
 
            <div class="navbar">
                <a href="home.php">Home</a>
                <a href="publisher.php">Publishers</a>
                <a href="recipie.php">Recipies</a>
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
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT name, username FROM user";
$result = mysqli_query($conn, $sql);

echo "<div class='publisher-list'>";
while($row = mysqli_fetch_assoc($result)) {
    echo "<div class='publisher'>";
    echo "<p>" . $row["name"] . "</p>";
    echo "<a href='profile.php?user=" . $row["username"] . "'>" . $row["username"] . "</a>";
    echo "</div>";
}
echo "</div>";
mysqli_close($conn);
?>
