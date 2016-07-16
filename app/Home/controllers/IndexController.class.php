<?php 
	use App\Controller;
	use App\Model;
	class IndexController extends Controller{
		public function index()
		{
			echo "this is from home/index/index";
			$model = M("test");
			$result = $model->getAll();
			dd($result);
			// E("525");
		}
	}