<?php

require_once("httpReq.php");

class Telemetry {


    public function __construct()
    {

    }

    public function getData() 
	{
		try {

			$api = new Authorization('https://telemetry-cdn.playbattlegrounds.com/bluehole-pubg/pc-eu/2018/04/15/15/33/601ebdc2-40c2-11e8-9295-0a58646d4810-telemetry.json');
            $json_file = $api->httpRequest($api->API_key, $api->api_url);
        }

        catch (Exception $e)
        {

        }
    }
}



?>