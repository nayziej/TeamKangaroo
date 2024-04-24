<?php include 'webConfig.php';

session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    <p class="welcome-message">Welcome to reciPIES, your go-to destination for culinary inspiration!
     Whether you're searching for a comforting classic or a daring new creation,
     our user-friendly platform makes it easy to find the perfect recipe.
 Join our vibrant community by sharing your own culinary creations and exploring a world of flavor. 
Start your journey with reciPIES today!</p>
    <div class="search-bar">
        <form name=data-select method=post>
            <input name="searchData" list="dataOptions">
            <datalist id="dataOptions">
                <option value="Publishers">
                <option value="Recipes">
                
            </datalist>
            <input name="phrase" class="search-box"type="text">
            <input name="submit" class="go" type="submit">
        </form>
        
    </div>

    <?php
        if(isset($_POST['phrase'])){
            $phrase = $_POST['phrase'];
        }else{
            $phrase = '';
        }
        
        if(isset($_POST['searchData'])){ 
            $namedb = $_POST['searchData'];
        }else{
            $namedb = '';
        }


        $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
        if(!$conn){
            die("Connection Failed: " . mysqli_connect_error());
        }
        
        if($namedb == 'Publishers'){
            if($phrase == ''){
                $sql = "SELECT * FROM user";
            }else{
                $sql = "SELECT * FROM user WHERE username LIKE '".$phrase."%'";
            }

            $results = mysqli_query($conn, $sql);
            if(mysqli_num_rows($results) > 0){
                echo '<p style="display:flex; margin-top:50px; justify-content:center; ">Users:</p>';
                while($row = mysqli_fetch_assoc($results)){
                    echo '<div style="margin-right:auto; margin-left:auto; margin-top:20px; justify-content:center; display:flex; width:fit-content; border: 1px solid black; background-color:grey" width:50%;><p style="margin-right:20px;">'.$row["name"].'</p><p>'.$row["username"].'</p></div>';
                }
            }else{
                echo "No results";
            }
        }else if($namedb == 'Recipes'){
            if($phrase == ''){
                $sql = "SELECT u.username, r.title, r.calories, r.id FROM user as u inner join recipie as r WHERE u.id = r.user_id";
            }else{
                $sql = "SELECT * FROM recipie WHERE title LIKE '".$phrase."%'";
            }

            $results = mysqli_query($conn, $sql);
            if(mysqli_num_rows($results) > 0){
                echo '<p style="display:flex; margin-top:50px; justify-content:center;">Recipes:</p>';

                while($row = mysqli_fetch_assoc($results)){
                    echo '<div style="margin-right:auto; margin-left:auto; margin-top:2    0px; justify-content:center; display:flex; width:fit-content; border: 1px solid black;     background-color:grey" width:50%;><p style="margin-right:20px;">'.$row["username"].'</p><a style="margin-right:20px;" href="recipie.php?rec_id='.$row['id'].'">'.$row["title"].'</a><p>'.$row["calories"].'</p></div>';
                }
            }else{
                echo 'No results';
            }
        }else if($namedb == 'Ingredients'){
            if($phrase == ''){
                $sql = "SELECT * FROM ingredient";
            }else{
                $sql = "SELECT * FROM ingredient WHERE name LIKE '".$phrase."%'";
            }
        }else{
            $sql = "SELECT * FROM discussion";
        }

        
        
    ?>   
     <div class="search-results">
         <?php   ?>                 
     </div>
</body>

</html>
