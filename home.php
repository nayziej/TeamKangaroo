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
        </form>
        <form class="search-box" placeholder="Search">
            <input type="text">
        </form>
        <form class="go">
            <input type="submit">
        </form> 
    </div>
    <div class="search-results">
        
    </div>
</body>

</html>
