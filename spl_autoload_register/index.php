<?php
/*
$class = 'test';
spl_autoload_register(function($class){
	include 'classes/'.$class. '.class.1.php';
});
new test();
*/
if(!function_exists('classAutoLoader'))
{	
	//自动加载最高版本的该类文件
	function classAutoLoader($className)
	{
		$classFiles = array();
		$classDir = __DIR__.'/classes/';
		$classFile = FALSE;
		$files = scandir($classDir);
		foreach ($files as $key => $value) 
		{
			if(is_file($classDir.$value) && preg_match('/([^\.]+)\.class\.([\d\.]+)\.(.+)$/', $value, $m))
			{
				if($className == $m[1])
				{
					$previous = isset($classFiles[$m[1]]) ? $classFiles[$m[1]] : 0;
					if($previous < $m[2])
					{
						$classFiles[$m[1]] = $m[2];
						$classFile = $classDir.$value;
					}
				}
			}
		}
		if( !class_exists($className) ) include( $classFile );
	}
}

spl_autoload_register('classAutoLoader');
new test();
/**
	输出结果：
	1.不打开上面注释时：
	this is test v2 class
	2.打开上面注释时：
	this is test v1 classthis is test v1 class
*/
