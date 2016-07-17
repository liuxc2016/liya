<?php

	define('APP_ROOT' , dirname(__FILE__));
	define('LIYA_ROOT', APP_ROOT.DIRECTORY_SEPARATOR."framework");
	
	
	// echo LIYA_ROOT;
	require LIYA_ROOT."/liya.php" ;

	$arr = array();
	
	$app = new \App\Framework();
	$app::run();