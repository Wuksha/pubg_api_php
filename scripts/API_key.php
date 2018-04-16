<?php
require_once("scripts/IRequest.php");
 class Authorization implements IRequest {

	public $API_key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJiY2UxMzQ1MC0xYmM4LTAxMzYtMzRhZC0wMzExMWE4MzhiNmMiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzMDE5NzcxLCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6InB1Ymctc3RhdHMtd2Vic2l0ZSIsInNjb3BlIjoiY29tbXVuaXR5IiwibGltaXQiOjEwfQ.miREOEm4iMfNhTr4aPFWFJ4lgouCU0Q3JUfXPwOHbJc";
	public static $authenticated = false;
	public $api_url;


	public function __construct($api_url)
	{
		$this->api_url = $api_url;
	}
	public function httpRequest($api, $url)
	{
		try {
			$opts = array(
			  'http'=>array(
			    'method'=>"GET",
			    'header'=>"Authorization:".$api."\r\n" .
			              "Accept: application/vnd.api+json\r\n"
			  )
			);

			$context = stream_context_create($opts);
			if($context === true)
			{
			$file = file_get_contents($url, false, $context);
			$obj = json_decode($file, true);
			Authorization::$authenticated = true;
			return $obj;
			}
			else 
			{
				echo "Error! Requsted file was not found!";
			}
			

		}

		catch(Exception $e)
		{
			var_dump("dsadsad");
		}
	}
}
?>
