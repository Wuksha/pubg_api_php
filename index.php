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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="navbar-collapse collapse w-100 dual-collapse2 order-1 order-md-0">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Current PUBG players: </a>
                </li>
            </ul>
        </div>
        <div class="mx-auto my-2 order-0 order-md-1 position-relative">
            <a class="mx-auto" href="#">
                <img src="Resource\icon-pubg@2x.png" >
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse w-100 dual-collapse2 order-2 order-md-2">
            <ul class="navbar-nav">
            <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Language
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">English</a>
        <a class="dropdown-item" href="#">Srpski</a>
        <a class="dropdown-item" href="#">French</a>
      </div>
    </li>
            </ul>
        </div>
</nav>
<section id="cover">
    <div id="cover-caption">
        <div id="main" class="container">
            <div class="row text-white">
                <div class="col-sm-10 offset-sm-1 text-center">
                    <h1 class="display-3">PUBG Stats</h1>
                    <div class="info-form">
                        <form class="form-inline justify-content-center" method = "post">
                            <div class="form-group">
                                <input type="text" class="form-control inp" placeholder="Enter PUBG Player Name" name = "playername">
                                <button type="submit" class="player-search-form__button" name = "submit">
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

