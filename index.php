<?php
include 'scripts/ChromePhp.php';
require_once('scripts/API_key.php');

$conn = new API('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJiY2UxMzQ1MC0xYmM4LTAxMzYtMzRhZC0wMzExMWE4MzhiNmMiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzMDE5NzcxLCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6InB1Ymctc3RhdHMtd2Vic2l0ZSIsInNjb3BlIjoiY29tbXVuaXR5IiwibGltaXQiOjEwfQ.miREOEm4iMfNhTr4aPFWFJ4lgouCU0Q3JUfXPwOHbJc', 'https://api.playbattlegrounds.com/shards/pc-eu/matches/ab1d316a-4b38-4a68-b359-1c4e19b562eb');
$conn->getJSON();


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
