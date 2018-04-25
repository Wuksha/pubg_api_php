<?php
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(isset($_POST["submit"]))
    {
        $playerName = $_POST['playername'];
        header("location:playerInfo.php/".$playerName);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div id="mainPosition">
       <div class = 'info'> <h1>Search</h1> </div>
        <div>
            <form class="player-search-form" method="post">
                <input class="player-search-form__text" id = "srch" type="text" placeholder="Enter player name" name = "playername">
                <button type="submit" class="player-search-form__button" name = "submit">
                    <i class="_spSite _spSite-84"></i>
                </button>
            </form>
        </div>
    </div>
</body>
</html>
