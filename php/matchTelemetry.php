<?php
require_once("ChromePhp.php");
require_once("httpReq.php");

class Telemetry {


    public function __construct()
    {

    }

    public function getData() 
	{
		try {

			$api = new Authorization('https://telemetry-cdn.playbattlegrounds.com/bluehole-pubg/pc-eu/2018/04/29/15/11/9bc26fce-4bbf-11e8-b00c-0a5864747914-telemetry.json');
            $json_file = $api->httpRequest($api->API_key, $api->api_url, "Telemetry data not found!");
            $i = 0;
            foreach($json_file as $key)
            {
                if($json_file[$i]['_T'] == "LogPlayerKill" && $json_file[$i]['victim']['name'] == 'Wuksha')
                {
                $killer = $json_file[$i]['killer'];
                $victim = $json_file[$i]['victim'];
                $victim_data = ['killer' => $killer, 'victim' => $victim];
                $json = json_encode($victim_data, JSON_PRETTY_PRINT);
                print_r($json);
                ChromePhp::log($victim_data);
                return $victim_data;
                break;
                }
        
                $i++;
            }

        }

        catch (Exception $e)
        {

        }
    }
}



?>