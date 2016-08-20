<?php

	namespace App;
	use duncan3dc\Laravel\BladeInstance;

	class Controller{

		protected $temple = [];
		protected $rendered;
		public $blade;

		public function __construct(){
			header("Content-Type : text/html;charset=utf-8");
			
			echo "this is from frameworkd's controller" ."<br>";
			// echo ROOT."app/".MODULE_NAME."/views/".CONTROLLER_NAME;die;
			$this->blade = new BladeInstance(ROOT."app/".MODULE_NAME."/views", ROOT."/data/cache/".MODULE_NAME."/views/".CONTROLLER_NAME);
		}
		
		public function display($view="")
		{
			echo $this->blade->render($view ,$this->temple);
		}

		public function assign($a , $v)
		{
			$this->temple[$a] = $v;
		}
	}