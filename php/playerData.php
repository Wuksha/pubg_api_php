<?php
require_once("httpReq.php");

class playerData {

    private $playerName;
    private $player_matches = array();

    public function __construct($pn)
	{
       $this->playerName = $pn;
	}

    public function getData()
    {
        try
        {
            $api = new Authorization("https://api.playbattlegrounds.com/shards/pc-eu/players?filter[playerNames]=".$this->playerName);
            $json_file = $api->httpRequest($api->API_key, $api->api_url, "Player not found!");

            if($api->authenticated == true)
            {
                $player_matches = [];
                foreach($json_file['data'] as $key)
                {
                    $o = 1;
                    foreach($key['relationships']['matches']['data'] as $key2)
                    {
                        $player_matches += ['Match '.$o => $key2['id']];
                        $o++;
                    }
                }
                return $player_matches;
            }

            else 
            {
            
            }
        }
        catch(Exception $ex)
        {
            echo ($ex->getMessage());
        }
    }
}

?>