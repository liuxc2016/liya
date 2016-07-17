<?php 
	use App\Controller;
	use App\Model;
	class IndexController extends Controller{
		public function index()
		{
			echo "this is from home/index/index";
			$model = M("test");
			$result = $model->getAll();
			// dd($result);
			// $this->display("index.hello");

			$this->assign("name" , "Liya");
			$this->assign("title" , "is good");

			$this->display("index.index");
			// E("525");
		}
	}