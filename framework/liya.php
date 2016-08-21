<?php
	
	define('DS' , DIRECTORY_SEPARATOR );
	define('ROOT', getcwd().DS);
	define('APP_PATH', ROOT.'app'.DS);
	define('FRAMEWORK_PATH', ROOT.'framework'.DS);
	define('LIBRARY_PATH', FRAMEWORK_PATH.'library'.DS);
	define('PUBLIC_PATH', ROOT.'public'.DS);
	define('COMMON_PATH', APP_PATH.'common'.DS);

	require_once(ROOT."vendor\autoload.php");
	require_once(COMMON_PATH."function.php");

	if(defined(APP_DEBUG)){
		ini_set('display_error','On');
	}else{
		ini_set('display_error','Off');

	}

	spl_autoload_register(function($class_name){
		if(is_file(LIBRARY_PATH."$class_name.class.php")){
			require_once LIBRARY_PATH."$class_name.class.php";
		}else{
			return false;
		}
	});

	//注册错误处理
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();

	$app = new App\Framework();

	return $app;
