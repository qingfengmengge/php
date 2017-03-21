<?php
/**
	一个生成器函数看起来像一个普通的函数，不同的是普通函数返回一个值，而一个生成器可以yield生成许多它所需要的值。
	当一个生成器被调用的时候，它返回一个可以被遍历的对象.当你遍历这个对象的时候(例如通过一个foreach循环)，PHP 将会在每次需要值的时候调用
	生成器函数，并在产生一个值之后保存生成器的状态，这样它就可以在需要产生下一个值的时候恢复调用状态。一旦不再需要产生更多的值，生成器函数
	可以简单退出，而调用生成器的代码还可以继续执行，就像一个数组已经被遍历完了。 
	生成器函数的核心是yield关键字。它最简单的调用形式看起来像一个return申明，不同之处在于普通return会返回值并终止函数的执行，而yield会
	返回一个值给循环调用此生成器的代码并且只是暂停执行生成器函数。
	NOTE:一个生成器不可以返回值：这样做会产生一个编译错误。然而return空是一个有效的语法并且它将会终止生成器继续执行。

	标准的 range() 函数需要在内存中生成一个数组包含每一个在它范围内的值，然后返回该数组, 结果就是会产生多个很大的数组。 比如，调用
	range(0, 1000000) 将导致内存占用超过 100 MB。做为一种替代方法, 我们可以实现一个 xrange() 生成器, 只需要足够的内存来创建 Iterator
	对象并在内部跟踪生成器的当前状态，这样只需要不到1K字节的内存。    
*/
function xrange($start, $limit, $step = 1){
	if($start < $limit)
	{
		if($step <= 0){
			throw new LogicException('Step must be +ve');
		}

		for($i = $start; $i <= $limit; $i += $step){
			yield $i;
		}
	}
	else
	{
		if($step >= 0){
			throw new LogicException('Step must be -ve');
		}

		for ($i = $start; $i >= $limit; $i += $step) {
            yield $i;
        }
	}
}

/* 
 * 注意下面range()和xrange()输出的结果是一样的。
 */
foreach (range(1, 9, 2) as $number) {
    echo "$number ";
}
echo "<br>";
foreach (xrange(1, 9, 2) as $number) {
    echo "$number ";
}
/*
result:
1 3 5 7 9
1 3 5 7 9
*/ 
