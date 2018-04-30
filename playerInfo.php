<?php
include 'scripts/ChromePhp.php';
require_once('scripts/httpReq.php');
require_once('scripts/playerData.php');
require_once('scripts/matchData.php');

$page_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  
$link_array = explode('/',$page_link);
$playerName = end($link_array);

$player = new playerData($playerName);
$matches_array = $player->getData();
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
    <link rel="stylesheet" type="text/css" href="../css/userInsight.css">
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
                <img src="..\Resource\icon-pubg@2x.png" >
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
                    <?php 
            for($i = 1; $i <= 2; $i++):
                $match = new matchData($matches_array["Match ".$i]);
                $match_deatils = $match->getData();
                ?>
                <div class = "match" id = "Match <?php echo $i ?>" >
                <?php
                $mode = $match_deatils['GameDetails']['gameMode'];
                $map = $match_deatils['GameDetails']['mapName'];
                $started = $match_deatils['GameDetails']['createdAt'];
                $start_date = substr($started, 0, 10);
                $started_time = substr($started, 11, 8);
                $duration = gmdate("i:s", $match_deatils['GameDetails']['matchDuration']);
                foreach($match_deatils as $key)
                {
                    if(isset($key['NumberOfPlayers']))
                    {
                        $players = $key['NumberOfPlayers'];
                        for($o = 1; $o <= $players; $o++)
                        {
                            if( isset($key['Player '.$o]))
                            {
                                if($key['Player '.$o]['PlayerName'] == $playerName)
                                {
                                    $rank = $key['Rank'];
                                    GLOBAL $rank;
                                    break;
                                }
                            }
                        }
                    }
                    else 
                    {
                        
                    }
                }
                ?>
                <p><?php echo "Game ".$i." mode: ".$mode; ?> </p>
                <p><?php echo "Game ".$i." map: ".$map; ChromePhp::log($match_deatils);?> </p>
                <p><?php echo "Game ".$i." date: ".$start_date;?> </p>
                <p><?php echo "Game ".$i." time: ".$started_time;?> </p>
                <p><?php echo "Game ".$i." duration: ".$duration;?> </p>
                <p><?php echo "Game ".$i." rank: ".$rank;?> </p>
                </div>
                <br>
            <?php endfor; 
            ?>
                    <br>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
