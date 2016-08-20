<?php
	// 40  diu dao 10 dan lanzi , (0-6)

	//  10 个 6
	//  [6, 6 , 6 ,6, 6,
	//   6, 6 , 6 ,6, 6]

	//   6,6,6,6,6 diu jin qu 20
	//   随机一次x 必须 20-x < (4*6)
	//   剩下4个数 要得到20-x ==存到$must
	//   随机一次得到y，有限制的，20-x-y必须<=18(3*6)

	//   随机一次, 有限制 20-x-y-z <=12

	//   不随机了，尽量先去填其中一个数，剩下的填给另外一个数
		header("Content-Type:text/html;charset=utf-8");
	  //rem多少个数，$total,生成总量，$必须达到的数据,$arr，临时变量用
	  //返回类型,$arr,即生成的随机数组
	  function test($rem, $total, $must, $arr)
	  {
	  	if($rem>=2)
	  	{
	  		$rem -= 1;
	  		$min = round($must - $rem * 6 , 2);
	  		if($min<=0)
	  			$min = 0;
	  		
	  		$max = ($must > 6) ? 6 : $must;
	  		$rand = round(mt_rand($min*100, $max*100)/100 , 2);
	  		$arr[] = $rand;	  		
  			$must = $must - $rand;
  			echo "生成rand数值:".$rand."本轮最小值".$min."本轮最大值".$max;
  			echo "--剩余随机次数:".$rem."----必须达成数据:".$must;
  			echo "<br>";
	  		return test($rem, $total, $must, $arr);
	  	}else{
	  		$arr[] = $must;
	  		return $arr;
	  	}

	  }
	  $arr = array();
	  $brr = test(10, 40, 40,$arr);
	  // $brr = test(4, 24, 24,$arr);
	  print_r($brr);
	  
