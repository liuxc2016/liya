<?php 
	use App\Controller;
	use App\Model;
	class IndexController extends Controller{
		public function index()
		{
			echo "this is from home/index/index";


			$this->assign("name" , "Liya");
			$this->assign("title" , "is good");

			$this->display("index");

		}
		public function pndex()
		{
			$model = M("users");
			$users = $model->getAll();
			$this->assign("name", 123);
			$this->assign("users", $users);
			$this->display("index.pndex");
		}
	}