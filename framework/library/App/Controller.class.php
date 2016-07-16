<?php

	namespace App;

	class Controller{
		public function __construct(){
			header("Content-Type : text/html;charset=utf-8");
			
			echo "this is from frameworkd's controller" ."<br>";
		}
	}