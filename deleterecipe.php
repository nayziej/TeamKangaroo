<?php
session_start();
include 'webConfig.php';

 if(isset($_GET['user'])&& $_GET['user'] === $_SESSION['username']){
 echo "<td></td></tr>";
}

$recipeId = $_GET['rec_id'];
$userId = $_SESSION['id']; // User ID from session

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ensure the recipe belongs to the user
$sql = "DELETE FROM recipie WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $recipeId, $userId);
mysqli_stmt_execute($stmt);
$affected_rows = mysqli_stmt_affected_rows($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);



header("Location: profile.php");
exit;
?>

