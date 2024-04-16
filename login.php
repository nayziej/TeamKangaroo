<?php include 'webConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="home.css" />
    <style>
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
        }

        .login-form-container {
            display: flex;
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .login-image {
            flex: 1;
            background-image: ('https://upload.wikimedia.org/wikipedia/commons/6/67/Buildings_in_Jackson%2C_North_Carolina.jpg');
            background-size: cover;
            background-position: center;
        }

        .login-form {
            flex: 1;
            padding: 40px;
        }

        .login-form h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="navbar-wrapper">
        <a href="home.php" class="logo">Title</a>

        <div class="navbar">
            <a href="home.php">Home</a>
            <a href="publishers.php">Publishers</a>
            <a href="recipie.php">Recipes</a>
            <a href="profile.php">Profile</a>
        </div>
        <div class="ls-buttons">
            <button  href="login.php" class="btn">Log In</button>
            <button href="signup.php" class="btn">Sign Up</button>
        </div>
    </div>

    <div class="login-container">
        <div class="login-form-container">
            <div class="login-form">
                <h2>Login</h2>
                <form method="post">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="login">Login</button>
                </form>
                <?php
                if (isset($_POST['login'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 1) {
                        // Username and password match, redirect to home.php
                        header("Location: home.php");
                        exit();
                    } else {
                        // Username and password do not match
                        echo "<p style='color: red;'>Invalid username or password.</p>";
                    }

                    mysqli_close($conn);
                }
                ?>
            </div>
            <div class="login-image"></div>
        </div>
    </div>
</body>

</html>

