<?
	namespace App;

	// defined(APP_ROOT)  or die("没有定义项目根目录");
	// defined(LIYA_ROOT) or die("没有定义liya根目录");
	class Framework{
		public static $app;
		public static $config;
		
		public function __construct()
		{
			self::$app = $this;
		}
		
		public static function run()
		{
			self::init();
			self::registerAutoload();
			self::dispatch();
		}

		public static function init()
		{
			define('DS' , DIRECTORY_SEPARATOR );
			define('ROOT', getcwd().DS);
			define('APP_PATH', ROOT.'app'.DS);
			define('FRAMEWORK_PATH', ROOT.'framework'.DS);
			define('LIBRARY_PATH', FRAMEWORK_PATH.'library'.DS);
			define('PUBLIC_PATH', ROOT.'public'.DS);
			define('COMMON_PATH', APP_PATH.'common'.DS);

			list($m,$c,$a) = self::getParams();
			define('MODULE_NAME' ,strtolower($m));
			define('CONTROLLER_NAME' ,strtolower($c));		
			define('ACTION_NAME' ,strtolower($a));
			
			define('MODULE_PATH', APP_PATH.MODULE_NAME.DS);
			define('CONTROLLER_PATH', MODULE_PATH."controllers".DS);
			define('MODEL_PATH', MODULE_PATH.'models'.DS);
			define('VIEW_PATH', MODULE_PATH.'views'.DS);

			define('COMMON_VIEW', VIEW_PATH.'common'.DS);
			define('ACTION_VIEW', VIEW_PATH.CONTROLLER_NAME.DS.ACTION_NAME.".html");

			session_start();
			require_once(ROOT."vendor\autoload.php");
			require_once(COMMON_PATH."function.php");
			//echo ROOT;die;
			
			//读取配置文件
			self::$config = include(APP_PATH."conf/app.php");

			//注册错误处理
			$whoops = new \Whoops\Run;
			$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
			$whoops->register();
		}

		private static function registerAutoload()
		{
			spl_autoload_register(function($class_name){
				if(strpos($class_name ,'Controller')){
					$target = CONTROLLER_PATH."$class_name.class.php";
					if(is_file($target)){
						require_once $target;
					}else{
						require_once LIBRARY_PATH."$class_name.class.php";
						// exit($target."在$target中找不到控制器".$class_name);
					}
				}elseif(strpos($class_name , "Model")){

					$target = MODEL_PATH."$class_name.class.php";
					if(is_file($target)){
						require_once $target;
					}else{
						require_once LIBRARY_PATH."$class_name.class.php";
						// exit($target."在$target中找不到控制器".$class_name);
					}					
					
				}else{
					if(is_file(require_once LIBRARY_PATH."$class_name.class.php")){
						require_once LIBRARY_PATH."$class_name.class.php";
					}else{
						return false;
					}
				}
				
			});
		}

		private static function dispatch()
		{
			$c = ucfirst(CONTROLLER_NAME)."Controller";
			$a = ACTION_NAME;

			$controller = new $c;
			if(class_exists($c))
			{
				$controller->$a();
			}else{
				echo "找不到".$controller."控制器" ;
			}
			
		}

		private static function getParams()
		{
			$m = isset($_GET['m'])?$_GET['m'] : 'home' ;
			$c = isset($_GET['c'])?$_GET['c'] : 'index';
			$a = isset($_GET['a'])?$_GET['a'] : 'index';
			return array($m , $c, $a );
		}

	}
