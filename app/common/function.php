<?php
	function dd($msg)
	{
		header("Content-Type : text/html;charset=utf-8");
		print("<pre>");
		var_dump($msg);
		print("<pre>");
		die();
	}