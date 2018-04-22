<?php
if(PHP_SAPI != 'cli'){
    die('Aplikacja nie zostala uruchomiona na konsoli');
}

function createSpace(int $n) : string {
	$space = "";
	for($i = 0; $i < $n; $i++) {
		$space .= " ";
	}
	return $space;
}

function helper(int $len,int $tmp) : int {
	return mb_strlen($len) - mb_strlen($tmp);
}

for($k = 1; $k < $argc; $k++) {
	$len = mb_strlen($argv[$k]);
	$mid = floor($len/2);

	for($i = 0; $i < $len; $i++) {
		if($i <= $mid) {
			$tmp = substr($argv[$k], $mid-$i, $i*2+1);
			echo mb_strlen($tmp).createSpace($mid-$i+helper($len, mb_strlen($tmp)))." $tmp";
		} else {
			$tmp = substr($argv[$k], $i-$mid, abs($len*2-$i*2-1));
			echo mb_strlen($tmp).createSpace($i-$mid+helper($len, mb_strlen($tmp)))." $tmp";
		}

		echo PHP_EOL;
	}
}

//OAUTH
