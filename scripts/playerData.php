<?php
require_once("httpReq.php");

class playerData extends Authorization {

    private $playerName;
    private $player_matches = array();

    public function __construct()
	{
       
	}

    public function getData()
    {
        try
        {
            $api = new Authorization("https://api.playbattlegrounds.com/shards/pc-eu/players?filter[playerNames]=HauntedLollipop");
            $json_file = $api->httpRequest($api->API_key, $api->api_url);

            if($api->authenticated == true)
            {
                $player_matches = [];
                ChromePhp::log($json_file);
                foreach($json_file['data'] as $key)
                {
                    $o = 1;
                    foreach($key['relationships']['matches']['data'] as $key2)
                    {
                        $player_matches += ['Match '.$o => $key2['id']];
                        $o++;
                    }
                }
                ChromePhp::log($player_matches);
            }

            else 
            {

            }
        }
        catch(Exception $ex)
        {

        }
    }
}

?>
