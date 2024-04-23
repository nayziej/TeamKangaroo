?php include 'webConfig.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="home.css" />
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
    <h1><?= htmlspecialchars('username') ?>'s Profile</h1>
    <h2>Recipes:</h2>
    <ul>
        <?php while ($recipe = mysqli_fetch_assoc($recipes_result)) { ?>
            <li><?= htmlspecialchars($recipe['name']) ?></li>
        <?php } ?>
    </ul>
 </body>
<?php


// Get the 'user' parameter from the URL
$user = isset($_GET['user']) ? $_GET['user'] : '';

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch user details (assuming 'Users' table has 'username' and 'user_id' columns)
$user_sql = "SELECT user_id, username FROM user WHERE username = ?";
$stmt = mysqli_prepare($conn, $user_sql);
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);
$user_result = mysqli_stmt_get_result($stmt);

if ($user_row = mysqli_fetch_assoc($user_result)) {
    $userId = $user_row['user_id'];
    $username = $user_row['username'];

    // Now, fetch the user's recipes (assuming 'Recipes' table has 'name' and 'user_id' columns)
    $recipes_sql = "SELECT name FROM Recipes WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $recipes_sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $recipes_result = mysqli_stmt_get_result($stmt);
} else {
    die("User not found.");
}
?>
</html>
<?php
mysqli_close($conn);
?>
