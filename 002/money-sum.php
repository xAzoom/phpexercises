<?php 
require_once(dirname(__FILE__).'/Formatter.php');
require_once(dirname(__FILE__).'/Money.php');

if(PHP_SAPI != 'cli'){
    die('Aplikacja nie zostala uruchomiona na konsoli');
}

$array = array();

$curr = $argv[1];
for($k = 2; $k < $argc; $k++) {
	array_push($array, new Money($curr, $argv[$k]));
}

$sum = new Money($curr, 0);
foreach ($array as $key => $value) {
	$sum->add($value);
}

$formatter = new Formatter(2, ".", " ");
echo $formatter->format($sum)." ".$sum->getCurrency();