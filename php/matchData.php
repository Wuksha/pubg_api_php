<?php
require_once("httpReq.php");
class matchData {

	private $roster_arr = array();
	private $participants_arr = array();
	private $match_details = array();
	private $matchID;
	public function __construct($mdID)
	{
		$this->matchID = $mdID;
	}

	public function getData() 
	{
		try {

			$api = new Authorization('https://api.playbattlegrounds.com/shards/pc-eu/matches/'.$this->matchID);
			$json_file = $api->httpRequest($api->API_key, $api->api_url, "Match not found!");
			if($api->authenticated == true)
			{
				$gameMode = $json_file['data']['attributes']['gameMode'];
				$mapName = $json_file['data']['attributes']['mapName'];
				$match_duration = $json_file['data']['attributes']['duration'];
				$createdAt = $json_file['data']['attributes']['createdAt'];
				$rostersInMatch = count($json_file['data']['relationships']['rosters']['data']);
				$match_details = ['GameDetails' => ['gameMode' => $gameMode, 'mapName' => $mapName, 'matchDuration' => $match_duration, 'numberOfTeams' => $rostersInMatch, 'createdAt' => $createdAt]];
				foreach ($json_file['included'] as $key) 
				{
					
					if($key['type'] == 'roster')
					{
						$roster_arr[] = ['Roster' => $key['id'], 'Rank' => $key['attributes']['stats']['rank'], 'teamNumber' => $key['attributes']['stats']['teamId']];
						$o = 1;
							foreach ($key['relationships']['participants']['data'] as $key1) 
							{
								$max= max(array_keys($roster_arr));
								$roster_arr[$max] += ['ParticipantID '.$o => $key1['id']];
								$o++;
							}
							$roster_arr[$max] += ['NumberOfPlayers' => $o - 1];
					}
					if($key['type'] == 'asset') 
					{
						$telemetry_arr = ['matchTelemetry' => ['url' => $key['attributes']['URL'], 'createdAt' => $key['attributes']['createdAt'], 'telemetryID' => $key['id']]];
						$match_details += $telemetry_arr;
					}	
				}
				foreach ($json_file['included'] as $key) 
				{
					if($key['type'] == 'participant')
					{
						$ParticipantID = $key['id'];
						$PlayerName = $key['attributes']['stats']['name'];
						$PlayerId = $key['attributes']['stats']['playerId'];
						$Kills = $key['attributes']['stats']['kills'];
						$Headshotkills = $key['attributes']['stats']['headshotKills'];
						$KillsPlace = $key['attributes']['stats']['killPlace'];
						$killPoints = $key['attributes']['stats']['killPoints'];
						$killPointsDelta = $key['attributes']['stats']['killPointsDelta'];
						$killStreak = $key['attributes']['stats']['killStreaks'];
						$longestKill = $key['attributes']['stats']['longestKill'];
						$teamKills = $key['attributes']['stats']['teamKills'];
						$roadKills = $key['attributes']['stats']['roadKills'];
						$Assists = $key['attributes']['stats']['assists'];
						$heals = $key['attributes']['stats']['heals'];
						$boosts = $key['attributes']['stats']['boosts'];
						$knockedOut = $key['attributes']['stats']['DBNOs'];
						$deathType = $key['attributes']['stats']['deathType'];
						$Revives = $key['attributes']['stats']['revives'];
						$vehicleDriveDistance = $key['attributes']['stats']['rideDistance'];
						$vehicleDestroys = $key['attributes']['stats']['vehicleDestroys'];
						$walkDistance = $key['attributes']['stats']['walkDistance'];
						$weaponsAcquired = $key['attributes']['stats']['weaponsAcquired'];
						$timeSurvived = $key['attributes']['stats']['timeSurvived'];
						$winPlace = $key['attributes']['stats']['winPlace'];
						$winPoints = $key['attributes']['stats']['winPoints'];
						$dmgDealt = $key['attributes']['stats']['damageDealt'];
						$lastKillPoints = $key['attributes']['stats']['lastKillPoints'];
						$lastWinPoints = $key['attributes']['stats']['lastWinPoints'];
						$mostDamage = $key['attributes']['stats']['mostDamage'];
						$winPointsDelta = $key['attributes']['stats']['winPointsDelta'];



						$participants_arr[] = [
						'ParticipantID' => $ParticipantID , 
						'PlayerName' => $PlayerName, 
						'PlayerID' => $PlayerId, 
						'Kills' => $Kills,
						'headshotKills' => $Headshotkills, 
						'killsPlace' => $KillsPlace, 
						'killPoints' => $killPoints, 
						'killPointsDelta' => $killPointsDelta, 
						'killStreak' => $killStreak, 
						'longestKill' => $longestKill, 
						'teamKills' => $teamKills, 
						'roadKills' => $roadKills, 
						'Assists' => $Assists, 
						'Heals' => $heals, 
						'Boosts' => $boosts, 
						'DBNOs' => $knockedOut, 
						'deathType' => $deathType, 
						'Revives' => $Revives, 
						'vehicleDriveDistance' => $vehicleDriveDistance, 
						'vehicleDestroys' => $vehicleDestroys, 
						'walkDistance' => $walkDistance, 
						'weaponsAcquired' => $weaponsAcquired, 
						'timeSurvived' => $timeSurvived, 
						'winPlace' => $winPlace, 
						'winPoints' => $winPoints,
						'dmgDealt' => $dmgDealt,
						'lastKillPoints' => $lastKillPoints,
						'lastWinPoints' => $lastWinPoints,
						'mostDamage' => $mostDamage,
						'winPointsDelta' => $winPointsDelta
						];
					}
				}

				$j = 0;
				foreach ($roster_arr as $rost) 
				{
					$l = 1;
						foreach ($participants_arr as $part)
	                    {
	                        $u = $part['ParticipantID'];
	                        for($i = 1; $i <= $rost['NumberOfPlayers']; $i++)
	                            {
	                            if($u == $rost['ParticipantID '.$i])
	                                {
	                                $roster_arr[$j] += ['Player '.$l => 
	                                ['PlayerName' => $part['PlayerName'], 
	                                'PlayerID ' => $part['PlayerID'], 
	                                'Kills' => $part['Kills'], 
	                                'headshotKills' => $part['headshotKills'], 
	                                'killsPlace' => $part['killsPlace'], 
	                                'killPoints' => $part['killPoints'],
	                                'killPointsDelta' => $part['killPointsDelta'], 
									'killStreak' => $part['killStreak'], 
									'longestKill' => $part['longestKill'], 
									'teamKills' => $part['teamKills'], 
									'roadKills' => $part['roadKills'],  
	                                'Assists' => $part['Assists'], 
	                                'Boosts' => $part['Boosts'],
	                                'DBNOs' => $knockedOut, 
									'deathType' => $deathType, 
									'Revives' => $Revives, 
									'vehicleDriveDistance' => $part['vehicleDriveDistance'], 
									'vehicleDestroys' => $part['vehicleDestroys'], 
									'walkDistance' => $part['walkDistance'], 
									'weaponsAcquired' => $part['weaponsAcquired'], 
									'timeSurvived' => $part['timeSurvived'], 
									'winPlace' => $part['winPlace'], 
									'winPoints' => $part['winPoints'],
									'dmgDealt' => $part['dmgDealt'],
									'lastKillPoints' => $part['lastKillPoints'],
									'lastWinPoints' => $part['lastWinPoints'],
									'mostDamage' => $part['mostDamage'],
									'winPointsDelta' => $part['winPointsDelta'],
									'Heals' => $part['Heals']
								]];
	                                    $l++;
	                                    break;
	                                }
	                            }
	                    }
	                    $j++;
	                    
				}
				$match_details += $roster_arr;
				return $match_details;
			}
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}

	}
}
?>