<?php
require_once("API_key.php");
class matchData extends Authorization {

	private $roster_arr = array();
	private $participants_arr = array();

	public function __construct()
	{

	}

	public function getData() 
	{
		try {
			$api = new Authorization('https://api.playbattlegrounds.com/shards/pc-eu/matches/2600c6e7-3796-415f-8891-f8bfbbd28d32');
			$json_file = Authorization::httpRequest($api->API_key, $api->api_url);
			$gameMode = $json_file['data']['attributes']['gameMode'];
			$mapName = $json_file['data']['attributes']['mapName'];
			$match_duration = $json_file['data']['attributes']['duration'];
			$createdAt = $json_file['data']['attributes']['createdAt'];
			ChromePhp::log($gameMode);
			ChromePhp::log($mapName);
			ChromePhp::log($json_file);
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
						$roster_arr[$max] += ['No' => $o - 1];
				}
			}


			foreach ($json_file['included'] as $key) 
			{
				if($key['type'] == 'participant')
				{
					$participants_arr[] = ['ParticipantID' => $key['id'], 'PlayerName' => $key['attributes']['stats']['name'], 'PlayerID' => $key['attributes']['stats']['playerId'], 'Kills' => $key['attributes']['stats']['kills'], 'Assists' => $key['attributes']['stats']['assists'], 'Boosts' => $key['attributes']['stats']['boosts']];
					

				}
			}

			$j = 0;
			foreach ($roster_arr as $rost) 
			{
				$l = 1;
				$w = $rost['ParticipantID 1'];
				$m = $rost['ParticipantID 2'];
					foreach ($participants_arr as $part)
                    {
                        $u = $part['ParticipantID'];
                        for($i = 1; $i <= $rost['No']; $i++)
                            {
                            if($u == $rost['ParticipantID '.$i])
                                {
                                $roster_arr[$j] += ['PlayerName '.$l => $part['PlayerName'], 'PlayerID '.$l => $part['PlayerID'], 'KillsPlayer '.$l => $part['Kills'], 'AssistsPlayer '.$l => $part['Assists'], 'BoostsPlayer '.$l => $part['Boosts'] ];
                                    $l++;
                                    break;
                                }
                            }
                    }
                    $j++;
			}
			
			ChromePhp::log($roster_arr);
			}

		catch(Exception $e)
		{
			echo $e->getMessage();
		}

	}
}
?>
