<?php
include 'webConfig.php';?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="home.css" />
    <style>
        .signup-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
        }

        .signup-form {
            max-width: 400px;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .signup-form h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .signup-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .signup-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .signup-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
 <div class="navbar-wrapper">         
<a href="home.php" class="logo">reciPIES</a>
 
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
    <div class="signup-container">
        <div class="signup-form">
            <h2>Sign Up</h2>
            <form method="post">
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="signup">Sign Up</button>
            </form>
            <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
                $name = $_POST['name'];
                $username = $_POST['username'];
                $password = $_POST['password'];

                $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                 $check_sql = "SELECT username FROM user WHERE username = ?";
                 $check_stmt = mysqli_prepare($conn, $check_sql);
                 mysqli_stmt_bind_param($check_stmt, "s", $username);
                 mysqli_stmt_execute($check_stmt);
                 mysqli_stmt_store_result($check_stmt);
    
                 if (mysqli_stmt_num_rows($check_stmt) > 0) {
                     $error = "Username already taken. Please choose a different one.";
                      } else {

                $sql = "INSERT INTO user (name, username, password) VALUES ('$name', '$username', '$password')";
                if (mysqli_query($conn, $sql)) {
                    echo "<p style='color: green;'>User created successfully. Navigate to Login Page to start the fun!</p>";
                } else {
                    echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
                }
                
                }
                
                mysqli_close($conn);
            }

            ?>
        </div>
    </div>
</body>

</html>
