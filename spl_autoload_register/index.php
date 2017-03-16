<?php
if(!function_exists('classAutoLoader'))
{
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
