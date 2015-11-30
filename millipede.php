#!/usr/bin/env php
<?php

use Millipede\Config;
use Millipede\Millipede;

require 'vendor/autoload.php';

if (PHP_SAPI !== 'cli') {
    echo 'This script should be invoked via the CLI version of PHP, not the '.PHP_SAPI.' SAPI'.PHP_EOL;
    die(52);
}

$size = isset($argv[1]) ? $argv[1] : 20;
$comment = isset($argv[2]) ? $argv[2] : 'Hello World!';
$config = (new Config())->withSize($size)->withComment($comment);
foreach (new Millipede($config) as $part) {
	echo $part, PHP_EOL;
}
die(0);
