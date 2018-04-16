<?php
require_once("httpReq.php");
class matchData extends Authorization {

	private $roster_arr = array();
	private $participants_arr = array();
	private $match_details = array();

	public function __construct()
	{

	}

	public function getData() 
	{
		try {

			$api = new Authorization('https://api.playbattlegrounds.com/shards/pc-eu/matches/2600c6e7-3796-415f-8891-f8bfbbd28d32d');
			$json_file = Authorization::httpRequest($api->API_key, $api->api_url);

			if(Authorization::$authenticated == true)
			{
				$gameMode = $json_file['data']['attributes']['gameMode'];
				$mapName = $json_file['data']['attributes']['mapName'];
				$match_duration = $json_file['data']['attributes']['duration'];
				$createdAt = $json_file['data']['attributes']['createdAt'];
				$match_details = ['GameDetails' => ['gameMode' => $gameMode, 'mapName' => $mapName, 'matchDuration' => $match_duration, 'createdAt' => $createdAt]];
				foreach ($json_file['included'] as $key) 
				{
					if($key['type'] == 'roster')
					{
						$roster_arr[] = ['Roster' => $key['id'], 'Rank' => $key['attributes']['stats']['rank'], 'teamNumber' => $key['attributes']['stats']['teamId']];
						$max = max(array_keys($roster_arr));
						$o = 1;
							foreach ($key['relationships']['participants']['data'] as $key1) 
							{
								$roster_arr[$max] += ['ParticipantID '.$o => $key1['id']];

								$o++;
							}
							$roster_arr[$max] += ['NumberOfPlayers' => $o - 1];
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
						$knocketOut = $key['attributes']['stats']['DBNOs'];
						$deathType = $key['attributes']['stats']['deathType'];
						$Revives = $key['attributes']['stats']['revives'];
						$vehicleDriveDistance = $key['attributes']['stats']['rideDistance'];
						$vehicleDestroys = $key['attributes']['stats']['vehicleDestroys'];
						$walkDistance = $key['attributes']['stats']['walkDistance'];
						$weaponsAcquired = $key['attributes']['stats']['weaponsAcquired'];
						$timeSurvived = $key['attributes']['stats']['timeSurvived'];
						$winPlace = $key['attributes']['stats']['winPlace'];
						$winPoints = $key['attributes']['stats']['winPoints'];

						$participants_arr[] = [
						'ParticipantID' => $ParticipantID , 
						'PlayerName' => $PlayerName, 
						'PlayerID' => $PlayerId, 
						'Kills' => $Kills,
						'Headshot kills' => $Headshotkills, 
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
						'Knocked out' => $knocketOut, 
						'deathType' => $deathType, 
						'Revives' => $Revives, 
						'vehicleDriveDistance' => $vehicleDriveDistance, 
						'vehicleDestroys' => $vehicleDestroys, 
						'walkDistance' => $walkDistance, 
						'weaponsAcquired' => $weaponsAcquired, 
						'timeSurvived' => $timeSurvived, 
						'winPlace' => $winPlace, 
						'winPoints' => $winPoints
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
	                                'Headshot kills' => $part['Headshot kills'], 
	                                'killsPlace' => $part['killsPlace'], 
	                                'killPoints' => $part['killPoints'],
	                                'killPointsDelta' => $part['killPointsDelta'], 
									'killStreak' => $part['killStreak'], 
									'longestKill' => $part['longestKill'], 
									'teamKills' => $part['teamKills'], 
									'roadKills' => $part['roadKills'],  
	                                'Assists' => $part['Assists'], 
	                                'Boosts' => $part['Boosts'],
	                                'Knocked out' => $knocketOut, 
									'deathType' => $deathType, 
									'Revives' => $Revives, 
									'vehicleDriveDistance' => $part['vehicleDriveDistance'], 
									'vehicleDestroys' => $part['vehicleDestroys'], 
									'walkDistance' => $part['walkDistance'], 
									'weaponsAcquired' => $part['weaponsAcquired'], 
									'timeSurvived' => $part['timeSurvived'], 
									'winPlace' => $part['winPlace'], 
									'winPoints' => $part['winPoints']
								]];
	                                    $l++;
	                                    break;
	                                }
	                            }
	                    }
	                    $j++;
	                    
				}
				$match_details += $roster_arr;
				ChromePhp::log($match_details);
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
