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
ChromePhp::log($matches_array);

for($i = 1; $i <= 10; $i++)
{

    $match = new matchData($matches_array["Match ".$i]);
    $match_deatils = $match->getData();
    var_dump($match_deatils);
}
?>
