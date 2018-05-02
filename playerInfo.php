<?php
include 'php/ChromePhp.php';
require_once('php/httpReq.php');
require_once('php/playerData.php');
require_once('php/matchData.php');
require_once('php/Cookies.php');

    $page_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  
    $link_array = explode('/',$page_link);
    $playerName = end($link_array);

    if(!Cookie::Exists("recentSearches"))
            {
                setcookie( "recentSearches", $playerName, time() + 36000, "/");
            }
            else 
            {
                $searches = $_COOKIE['recentSearches'];
                $decoded = urldecode($searches);
                $arr = explode(",", $decoded);
                $x = Cookie::checkValue($arr, $playerName);
                if($x != true)
                setcookie("recentSearches", $searches.",".$playerName, time() + 36000, "/"); 
            }
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
    <link rel="stylesheet" type="text/css" href="../css/userInsight.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="../js/Cookies.js"></script>
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
                <img src="..\resources\pubg-icon.png" >
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
                    <?php
                    function ago($date)
                    {
                        $d = $date;
                        $days = intval($date / 86400)." days ago";
                        if($days < 1)
                        {
                            $days = intval($d/3600)." hours ago";
                        }
                        if($days < 1)
                            {
                                $days = intval($d/60)." minutes ago";
                        }
    
                            return $days;
                    }
            for($i = 1; $i <= 10 ; $i++):
                $match = new matchData($matches_array["Match ".$i]);
                $match_deatils = $match->getData();
                ?>
                <div class = "match col-lg-6" data-match-number = "Match <?php echo $i ?>" >
                <?php
                $mode = $match_deatils['GameDetails']['gameMode'];
                $map = $match_deatils['GameDetails']['mapName'];
                $started = $match_deatils['GameDetails']['createdAt'];
                $start_date = substr($started, 0, 10);
                $started_time = substr($started, 11, 8);
                $d=strtotime($start_date." ".$started_time);
                $date = date("Y-m-d H:i:s", $d);
                date_default_timezone_set(htmlentities($_COOKIE['Zone'], 3, 'UTF-8')); 
                $currDate = date("Y-m-d H:i:s"); 
                $datetime1 = strtotime($date);
                $datetime2 = strtotime($currDate);
                $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                $duration = gmdate("i:s", $match_deatils['GameDetails']['matchDuration']);
                $index = 0;
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
                                    $selectedPlayer = $o;
                                    $noOfElement = $index - 2;
                                    GLOBAL $rank, $selectedPlayer, $noOfElement;
                                    break 2;
                                }
                            }
                        }
                    }
                    else 
                    {
                        
                    }
                    $index++;
                }
                $kills = $match_deatils[$noOfElement]['Player '.$selectedPlayer]['Kills'];
                $dmg = $match_deatils[$noOfElement]['Player '.$selectedPlayer]['dmgDealt'];
                $walk_distance = $match_deatils[$noOfElement]['Player '.$selectedPlayer]['walkDistance'];
                $vehicle_distance = $match_deatils[$noOfElement]['Player '.$selectedPlayer]['vehicleDriveDistance'];
                $totalDistance = intval($walk_distance + $vehicle_distance);
                $winRank = intval($match_deatils[$noOfElement]['Player '.$selectedPlayer]['winPointsDelta']);
                ?>
                <div class = "match-box">
                <i class="sp__mode sp__mode--2-fpp">
                <?php 
                echo "Game ".$i." mode: ".$mode;?>
                </i>
                <div class = "match-map">
                Map: 
                <a data-toggle="tooltip" title="<img src='<?php if($map == "Erangel_Main") { echo '../resources/erangel_mini.png';}
                else if ($map == "Desert_Main") { echo '../resources/miramar-mini.png';} ?>' />">
                <span id="<?php if($map == "Erangel_Main") { echo 'map-er';}
                else if ($map == "Desert_Main") { echo 'map-mi';} ?>"><?php if($map == "Erangel_Main") { echo 'Erangel';}
                else if ($map == "Desert_Main") { echo 'Miramar';} ?></span></a>
                </div>
                <hr>
                <div class = "matchStart"><?php $hm = ago($secs); echo $hm;?> </div>
                <div class = "matchDuration"><?php echo $duration; ?></div>
                <div class = "match__rank">#<?php echo $rank; ?>/48</div>
                </div>
                
                </div>
            <?php endfor; 
            ?>
                    <br>
                </div>
        </div>
    </div>
</section>
<script src="../js/jQuery.js"></script>
</body>
</html>
