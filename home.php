<?php include 'webConfig.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css" />
</head>

<body>
    <div class=navbar-wrapper>
        <a href="home.php" class="logo">Title</a>

        <div class="navbar">
            <a href="">Home</a>
            <a href="">Publishers</a>
            <a href="">Recipies</a>
            <a href="">Profile</a>
        </div>
        <div class="ls-buttons">
            <button class="btn" type="button" href="">Log In</button>
            <button class="btn" type="button" href="">Sign Up</button>   
        </div>
    </div>
    <div class="search-bar">
        <form name=data-select method=post>
            <input name="searchData" list="dataOptions">
            <datalist id="dataOptions">
                <option value="Publishers">
                <option value="Recipies">
                <option value="Ingredients">
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


        $conn = mysqli_connect($servername, $username, $password, $dbname);
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
        }else if($namedb == 'Recipies'){
            if($phrase == ''){
                $sql = "SELECT * FROM recipie";
            }else{
                $sql = "SELECT * FROM recipie WHERE title LIKE '".$phrase."%'";
            }

            $results = mysqli_query($conn, $sql);
            if(mysqli_num_rows($results) > 0){
                echo '<p style="display:flex; margin-top:50px; justify-content:center;">Recipies</p>';

                while($row = mysqli_fetch_assoc($results)){
                    echo '<div style="margin-right:auto; margin-left:auto; margin-top:2    0px; justify-content:center; display:flex; width:fit-content; border: 1px solid black;     background-color:grey" width:50%;><p style="margin-right:20px;">'.$row["title"].'</p><p>    '.$row["calories"].'</p></div>';
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
