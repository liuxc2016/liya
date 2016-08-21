<?
	namespace App;

	// defined(APP_ROOT)  or die("没有定义项目根目录");
	// defined(LIYA_ROOT) or die("没有定义liya根目录");
	class Framework{
		public static $app;
		public static $config;
		public static $moduleName;
		public static $controllerName;
		public static $actionName;
		public static $route;

		public function __construct()
		{
			self::$app = $this;
			session_start();
		}
		
		public static function run()
		{
			self::init();
			self::$route->dispatch();
		}

		public static function init()
		{

			//读取配置文件
			self::$config = include(APP_PATH."conf/app.php");

			self::$route = new Route();
			list(self::$moduleName, self::$controllerName, self::$actionName)  = self::$route->setRouteParam();
			self::registerAutoload();


			define('MODULE_PATH', APP_PATH.MODULE_NAME.DS);
			define('CONTROLLER_PATH', MODULE_PATH."controllers".DS);
			define('MODEL_PATH', MODULE_PATH.'models'.DS);
			define('VIEW_PATH', MODULE_PATH.'views'.DS);

			define('COMMON_VIEW', VIEW_PATH.'common'.DS);
			define('ACTION_VIEW', VIEW_PATH.CONTROLLER_NAME.DS.ACTION_NAME.".html");

			if(defined(APP_DEBUG)){
				ini_set('display_error','On');
			}else{
				ini_set('display_error','Off');

			}

		}


		private static function registerAutoload()
		{
			spl_autoload_register(function($class_name){

				if(strpos($class_name ,'Controller')){
					$target = CONTROLLER_PATH."$class_name.class.php";
					if(is_file($target)){
						require_once $target;
					}else{
						if(is_file(LIBRARY_PATH."$class_name.class.php"))
						{
							require_once LIBRARY_PATH."$class_name.class.php";
						}else{
							throw new \Exception("找不到控制器".$class_name);
						}

					}
				}elseif(strpos($class_name , "Model")){

					$target = MODEL_PATH."$class_name.class.php";
					if(is_file($target)){
						require_once $target;
					}else{
						if(is_file(LIBRARY_PATH."$class_name.class.php"))
						{
							require_once LIBRARY_PATH."$class_name.class.php";
						}else{
							throw new \Exception("找不到模型".$class_name);
						}
					}					
					
				}else{
					//$class_name = str_replace("\\", "", $class_name);
					//dd($class_name);
					if(is_file(require_once LIBRARY_PATH."$class_name.class.php")){
						require_once LIBRARY_PATH."$class_name.class.php";
					}else{
						return false;
					}
				}
				
			});
		}



		

	}

