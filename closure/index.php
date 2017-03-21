<?php
//匿名函数把它定义或返回(闭包情况)给一个变量，
//这个变量后面加上(),就会执行该匿名函数
function createGreeter($who){
	return function()use($who){
		echo "hello $who";
	};
}
$greeter = createGreeter('world');
$greeter();//hello world
$a = function(){
	echo 'a';
};
$a();
