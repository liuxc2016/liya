<?php

	namespace App;

	class Controller{

		protected $temple;
		protected $rendered;

		public function __construct(){
			header("Content-Type : text/html;charset=utf-8");
			
			echo "this is from frameworkd's controller" ."<br>";
		}
		public function display($view="")
		{
			
			ob_clean();
			if(empty($view)){
				if(is_file(ACTION_VIEW)){
					$viewfile = ACTION_VIEW;
				}else{
					dd("找不到模版文件".ACTION_VIEW);
				}
			}elseif(is_file(VIEW_PATH.str_replace(".", DIRECTORY_SEPARATOR, $view).".html")){
				
				$viewfile =VIEW_PATH.str_replace(".", DIRECTORY_SEPARATOR, $view).".html";
			}
			// echo VIEW_PATH.str_replace(".", DIRECTORY_SEPARATOR, $view).".html";
			$this->temple = file_get_contents($viewfile);

			$this->render($this->temple);

			echo $this->rendered;
		}

		public function render($temple)
		{
			global $arr;
			// print_r($arr);
			// echo "目标字符串是".$temple."<br>" ; 
			
			$replace_func = function($m) use ($arr)
			{
					$arr;
					$a = $m[1];
					return $arr[$a];
			};
			$this->rendered = preg_replace_callback('/\{\\$([\w]+)\}/', $replace_func, $temple);
			// echo "经渲染后成为：".$this->rendered."<br>";

		}

		public function assign($a , $v)
		{
			global $arr;
			$arr[$a] = $v ;
		}
	}