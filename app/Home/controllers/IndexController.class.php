<?php 
	use App\Controller;
	use App\Model;
	class IndexController extends Controller{
		public function index()
		{

			$this->assign("name" , "Liya");
			$this->assign("title" , "is good");

			$this->display("index.index");

		}
		public function pndex()
		{
			$model = M("users");
			$users = $model->get();
			dd($model);
			$this->assign("name", 123);
			$this->assign("users", $users);
			$this->display("index.pndex");
		}
	}