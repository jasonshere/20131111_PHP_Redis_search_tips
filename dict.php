<?php
	//链接redis数据库
	$redis = new redis();

	$redis->connect("localhost",6379);

	header("content-type:text/html;charset=utf-8");
	//读取字典文件
	$lines = file("/tmp/words.txt");

	/*echo "<pre>";

	var_dump($lines);	

	echo "</pre>";*/
	//获取到一个数组，数组的每一个元素就是每一行话

	//批量处理这个数组的每个元素就是处理每一行话
	foreach($lines as $line){
		$str = "";
		$line = rtrim($line,"\n");
		for($i=0;$i<strlen($line);$i++){
			$str .= mb_substr($line,$i,1,'utf-8');
			//将分好的词插入到有序集合当中
			$redis->zadd('words',0,$str);
		}
	}

	$words = $redis->zrange("words",0,-1);

	echo "<pre>";
	var_dump($words);
	echo "</pre>";


