<?php
include 'webConfig.php';
session_start();


$recipeId = $_GET['rec_id'];
$userId = $_SESSION['id'];

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Fetch the current recipe details
$sql = "SELECT title, directions FROM recipie WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $recipeId, $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$recipe = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Update the recipe if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['directions'])) {
    $newTitle = $_POST['title'];
    $newDescription = $_POST['directions'];

    $updateSql = "UPDATE recipie SET title = ?, directions = ? WHERE id = ? AND user_id = ?";
    $updateStmt = mysqli_prepare($conn, $updateSql);
    mysqli_stmt_bind_param($updateStmt, "ssii", $newTitle, $newDescription, $recipeId, $userId);
    mysqli_stmt_execute($updateStmt);
    mysqli_stmt_close($updateStmt);

    header("Location: profile.php"); // Redirect to a general recipe page or profile
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>" />
</head>
<body>
    <div class="navbar-wrapper">
        <img src="images/recipies1.png" alt="reciPIES Logo" style="height: 100px; width: 100px;">
        <div class="navbar">
            <a href="home.php">Home</a>
            <a href="publisher.php">Publishers</a>
            <a href="discussion.php">Discussions</a>
            <a href="recipie.php">Recipes</a>
            <a href="profile.php">Profile</a>
        </div>
    </div>

    <h1>Edit Recipe</h1>
    <?php if (isset($recipe)): ?>
        <form action="" method="post">
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($recipe['title']); ?>" required>
            </div>
            <div>
                <label for="directions">Directions:</label>
                <textarea id="directions" name="directions" rows="4" cols="50" required><?= htmlspecialchars($recipe['directions']); ?></textarea>
            </div>
            <div>
                <input type="submit" value="Update Recipe">
            </div>
        </form>
    <?php else: ?>
        <p>Recipe not found or you do not have permission to edit it.</p>
    <?php endif; ?>

    <footer>
        <a href="logout.php" class="logout-link">Logout</a>
    </footer>
</body>
</html>

