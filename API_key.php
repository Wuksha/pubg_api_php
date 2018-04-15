<?php
 class API {

	protected $API_key;
	protected $api_url;
	protected $arr = array();
	protected $roster_arr = array();
	protected $final = array();

	public function __construct($API_key, $api_url)
	{
		$this->API_key = $API_key;
		$this->api_url = $api_url;
	}

	public function getJSON1() 
	{
		$opts = array(
		  'http'=>array(
		    'method'=>"GET",
		    'header'=>"Authorization:".$this->API_key."\r\n" .
		              "Accept: application/vnd.api+json\r\n"
		  )
		);

		$context = stream_context_create($opts);

		$file = file_get_contents($this->api_url, false, $context);
		$obj = json_decode($file, true);
		$i = 0;	
		foreach ($obj['data']['relationships']['rosters']['data'] as $key) 
		{
				$i++;
				$tmp = [];
		    	$tmp['Team '.$i] = $key['id'];
		    	$arr[] = $tmp;

		}
		ChromePhp::log($obj);

		foreach ($arr as $key => $value) 
		{
			#ChromePhp::log($value); 
		}
	}

		public function getJSON() 
	{
		$opts = array(
		  'http'=>array(
		    'method'=>"GET",
		    'header'=>"Authorization:".$this->API_key."\r\n" .
		              "Accept: application/vnd.api+json\r\n"));

		$context = stream_context_create($opts);
		$file = file_get_contents($this->api_url, false, $context);
		$obj = json_decode($file, true);
		foreach ($obj['included'] as $key) 
		{
			if($key['type'] == 'roster')
			{
				$roster_arr[] = ['rooster_id' => $key['id'], 'rank' => $key['attributes']['stats']['rank'], 'teamNumber' => $key['attributes']['stats']['teamId']];
				$max = max(array_keys($roster_arr));
						foreach ($key['relationships']['participants']['data'] as $key1) {
 							
    						$roster_arr[$max] += ['PlayerId' => $key1['id']];
							ChromePhp::log($key1['id']);

						}
						ChromePhp::log("\r\n");
			}
		}
		ChromePhp::log($obj);
		ChromePhp::log($roster_arr);
echo '<pre>';
var_dump($roster_arr);
echo '<pre>';

	}
	}
?>