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

	function M($a)
	{

		return new Model($a);
	}