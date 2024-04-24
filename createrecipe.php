<?php include 'webConfig.php';
session_start();?>

 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>
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
        <div>
            <h2>Create Recipe</h2>
        </div>
<?php
if (!isset($_SESSION['id'])) {
    // User is not logged in. Display a message instead of the form
    $message = "You must be logged in to create a recipe. <a href='login.php'>Log in here</a>";
} else {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $directions = $_POST['directions'];
    $userId = $_SESSION['id']; // Assuming you store user_id in session on login
    $cals = $_POST['cals'];

    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO recipie (user_id, title, directions, calories) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issi", $userId, $title, $directions, $cals);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: recipie.php"); // Redirect to recipes page
    exit;
}
}
?>
    <form method="post" action="">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="directions">Directions:</label>
        <textarea id="directions" name="directions" required></textarea><br>
        <label for="cals">Calories:</label>
        <input type="text" id="cals" name="cals"><br>
        <input type="submit" value="Create Recipe">
    </form>


</body>
</html>
