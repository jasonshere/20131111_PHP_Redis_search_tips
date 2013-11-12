<?php
	header("content-type:text/html;charset=utf-8");
	//链接redis数据库
	$redis = new redis();

	$redis->connect("localhost",6379);

	$key = $_GET['key'];

	$rank = $redis->zrank("words",$key);

	$search = $redis->zrange("words",$rank,-1);


	foreach($search as $word){
		if(strstr($word,$key)){
			$data[] = $word;
		}
	}

	//echo "<pre>";
	//var_dump($data);
	//echo "</pre>";

	echo json_encode($data);
