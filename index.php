<?php
include 'scripts/ChromePhp.php';
require_once('scripts/API_key.php');
require_once('scripts/matchData.php');

$match = new matchData();
$match->getData();


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
       <!-- <div class = 'info'> <h1>:)</h1> </div>
        <div>
            <form class="player-search-form" action = "conn.php">
                <input class="player-search-form__text" id = "srch" type="text" placeholder=":)" name="userName">
                <button type="submit" class="player-search-form__button">
                    <i class="_spSite _spSite-84"></i>
                </button>
            </form>
        </div>-->
    </div>
</body>
</html>
