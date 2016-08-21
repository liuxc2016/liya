<?php

	define('APP_ROOT' , dirname(__FILE__));
	define('LIYA_ROOT', APP_ROOT.DIRECTORY_SEPARATOR."framework");

	define('APP_DEBUG', true);


		

	$app = require LIYA_ROOT."\liya.php" ;

	//$app = new App\Framework();

	$app::run();