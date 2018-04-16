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
			$api = new Authorization('https://api.playbattlegrounds.com/shards/pc-eu/matches/ab1d316a-4b38-4a68-b359-1c4e19b562eb');
			$json_file = Authorization::httpRequest($api->API_key, $api->api_url);
			$gameMode = $json_file['data']['attributes']['gameMode'];
			$mapName = $json_file['data']['attributes']['mapName'];
			$match_duration = $json_file['data']['attributes']['duration'];
			$createdAt = $json_file['data']['attributes']['createdAt'];
			ChromePhp::log($gameMode);
			ChromePhp::log($mapName);
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
				}
			}
			ChromePhp::log($roster_arr);
			ChromePhp::log($json_file);


			foreach ($json_file['included'] as $key) 
			{
				if($key['type'] == 'participant')
				{
					$participants_arr[] = ['ParticipantID' => $key['id'], 'PlayerName' => $key['attributes']['stats']['name'], 'PlayerID' => $key['attributes']['stats']['playerId'], 'Kills' => $key['attributes']['stats']['kills'], 'Assists' => $key['attributes']['stats']['assists'], 'Boosts' => $key['attributes']['stats']['boosts']];
					

				}
			}
			ChromePhp::log($participants_arr);

			foreach ($roster_arr[0] as $key) {
				foreach ($participants_arr['ParticipantID'] as $key2) {
					if($key == $key2)
					{
						ChromePhp::log("jea");
					}
				}
			}


		}

		catch(Exception $e)
		{
			echo $e->getMessage();
		}

	}
}
?>