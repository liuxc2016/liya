<?php 
	use App\Controller;
	use App\Model;
	class WeixinController extends Controller{
		protected $appid  	  = "wx08cf2f9d549086b6" ;
		protected $appsecret  = "bdea9e355356fcf16803b2ae079e48d6" ;

		protected $code;
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

		public function getBase()
		{
			$appid = $this->appid;
			$redirect_uri = "";
			
			$scope = "snsapi_base"; 
			$redirect_uri= urlencode("http://liya.com/index.php?m=home&c=weixin&a=showBase");
			// echo $redirect_uri;die;
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=".$scope."&state=123#wechat_redirect";
			header("Location:".$url);
		}

		public function getInfo()
		{
			$appid = $this->appid;
			$redirect_uri = "";
			
			$scope = "snsapi_userinfo"; 
			$redirect_uri= urlencode("http://liya.com/index.php?m=home&c=weixin&a=showInfo");
			// echo $redirect_uri;die;
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=".$scope."&state=123#wechat_redirect";
			header("Location:".$url);
		}

		public function showBase()
		{
			$code = $_GET['code'];
			if(empty($code))
				dd("没有获取到code授权");
			$appid = $this->appid;
			$appsecret = $this->appsecret;

			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$code."&grant_type=authorization_code";
			// echo $url;die;
			$res = curl_get($url);
			$res = json_decode($res);
			$openid = $res->openid;
			if($openid)
			{
				$model = M('user');

				$result = $model->findByOpenid($openid);
				if($result){
					// dd($result);
					echo "欢迎您".$result[0]['name'].$openid."再次登陆";
				}else{
					$data['openid'] = $res->openid;
					$ret = M('user')->data($data)->add();
					echo "恭喜你注册成功用户 openid为：".$openid;
				}
			}else{
				echo "使用code:".$code."没有获得用户openid,请重新确认！".$res->errmsg;
				dd($res);
			}

			

		}

		public function test()
		{
			// $data['openid'] = "3333333";
			// $data['name']   = "test";
			// M('user')->data($data)->add();
			$res = M('user')->findByOpenid("o2QXXvr0VDbDme7IN_Yx1LEfUUrI");
			dd($res);
		}

		public function showInfo()
		{
			$code = $_GET['code'];
			if(empty($code))
				dd("没有获取到code授权");
			$appid = $this->appid;
			$appsecret = $this->appsecret;

			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$code."&grant_type=authorization_code";
			// echo $url;die;
			$res = curl_get($url);
			$res = json_decode($res);
			$openid = $res->openid;
			if($openid)
			{
				$web_access_token = $res->access_token ;	
				$url2 = "https://api.weixin.qq.com/sns/userinfo?access_token=".$web_access_token."&openid=".$openid."&lang=zh_CN";	
				$res2 = curl_get($url2);
				if(!$res2)
				{
					dd("curl 拉取用户信息出错！");
				}else{
					dnd($res2);
					$res2 = json_decode($res2);
					$model = M('user');
					$result = $model->findByOpenid($openid);
					if($result){
						// dd($result);
						echo "欢迎您".$result[0]['name'].$openid."再次登陆";
						echo "<img src='".$result[0]['avatar']."'>";
					}else{
						$data['openid'] = $res->openid;
						$data['name']   = $res2->nickname;
						$data['avatar'] = $res2->headimgurl;
						$ret = M('user')->data($data)->add();
						echo "恭喜你注册成功用户 openid为：".$openid;
						echo "<img src='".$res2->headimgurl."'>";
					}

				}
			
			}else{
				echo "使用code:".$code."没有获得用户openid,请重新确认！".$res->errmsg;
				if($res->errcode =="40029"){
					$url = "index.php?c=weixin&a=getInfo";
					header("Location:".$url);
				}
			}

			

		}
	}