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

for($i = 1; $i <= 2; $i++)
{

    $match = new matchData($matches_array["Match ".$i]);
    $match_deatils = $match->getData();
    ChromePhp::log($match_deatils);
}
?>