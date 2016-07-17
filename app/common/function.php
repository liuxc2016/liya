<?php
	use App\Model;
	function dd($msg)
	{
		header("Content-Type : text/html;charset=utf-8");
		print("<pre>");
		var_dump($msg);
		print("<pre>");
		die();
	}
	function dnd($msg)
	{
		header("Content-Type : text/html;charset=utf-8");
		print("<pre>");
		var_dump($msg);
		print("<pre>");
	}

	function M($a)
	{

		return new Model($a);
	}

	function curl_get($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
		$return = curl_exec($ch);
		curl_close($ch);
		return $return;
	}