<?php

	namespace App;

	class Route{
		public $pathString;
		public $m, $c , $a;
		public function __construct(){

		}
		
		public function display($view="")
		{
			echo $this->blade->render($view ,$this->temple);
		}

		public function getParams($pathmode=1)
		{
			if($pathmode==2)
			{
				$this->m = isset($_GET['m'])?$_GET['m'] : 'home' ;
				$this->c = isset($_GET['c'])?$_GET['c'] : 'index';
				$this->a = isset($_GET['a'])?$_GET['a'] : 'index';

			}else{
				if(empty($_SERVER['PATH_INFO'])){
					$_SERVER['PATH_INFO'] = "/";
				}
				$pathinfoString = trim($_SERVER['PATH_INFO'],"/");
				$pathinfoArray = explode("/", $pathinfoString);
				
				if(sizeof($pathinfoArray)==0){
					$this->m = 'home';
					$this->c = 'index';
					$this->a = 'index';
				}elseif(sizeof($pathinfoArray)==1){
					$this->m = $pathinfoArray[0];
					$this->c = 'index';
					$this->a = 'index';
				}elseif(sizeof($pathinfoArray)==2){
					$this->m = $pathinfoArray[0];
					$this->c = $pathinfoArray[1];
					$this->a = 'index';
				}elseif(sizeof($pathinfoArray)==3){
					$this->m = $pathinfoArray[0];
					$this->c = $pathinfoArray[1];
					$this->a = $pathinfoArray[2];
				}else{
					$this->m = $pathinfoArray[0];
					$this->c = $pathinfoArray[1];
					$this->a = $pathinfoArray[2];
					for($i=3; $i<sizeof($pathinfoArray);$i+=2)
					{
						if(empty($pathinfoArray[$i+1])){
							$_GET[$pathinfoArray[$i]] = "";
							break;
						}else{
							$_GET[$pathinfoArray[$i]] = $pathinfoArray[$i+1];
						}
					}
				}
			}
		}

		public function setRouteParam(){
			$this->getParams();
			$this->m = empty(strtolower($this->m))?'home':strtolower($this->m);
			$this->c = empty(strtolower($this->c))?'index':strtolower($this->c);
			$this->a = empty(strtolower($this->a))?'index':strtolower($this->a);
			define('MODULE_NAME', $this->m );
			define('CONTROLLER_NAME', $this->c);
			define('ACTION_NAME', $this->a);
			return array($this->m, $this->c, $this->a);
		}

		/**
		 *
		 *
		*/
		public function dispatch()
		{
			
			$c = ucfirst($this->c)."Controller";
			$a = $this->a;

			if(class_exists($c))
			{
				$controller = new $c;
				$controller->$a();

			}else{
				throw new \Exception( "找不到".$c."控制器" );
				die;
			}
			
		}
	}