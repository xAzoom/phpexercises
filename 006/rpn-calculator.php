<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 13.04.2018
 * Time: 00:01
 */

use RPNCalculator\RPNCalculator;

require_once __DIR__ . '/vendor/autoload.php';

if (PHP_SAPI != 'cli') {
    die('Aplikacja nie zostala uruchomiona na konsoli');
}

$RPNcalculator = new RPNCalculator();
echo $RPNcalculator->calculate($argv[1]);