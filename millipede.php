#!/usr/bin/env php
<?php

if (PHP_SAPI !== 'cli') {
    echo 'This script should be invoked via the CLI version of PHP, not the '.PHP_SAPI.' SAPI'.PHP_EOL;
    die(52);
}

function millipede($size)
{
    $size = filter_var($size, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'default' => 20]]);
    $paddingOffsets = ['  ', ' ', '', ' ', '  ', '   ', '    ', '   '];
    yield '    ╚⊙ ⊙╝';
    $i = 0;
    do {
        yield $paddingOffsets[++$i % 8].'╚═(███)═╝';
    } while ($i < $size);
}

$size = isset($argv[1]) ? $argv[1] : 20;
echo PHP_EOL;
foreach (millipede($size) as $output) {
    echo $output.PHP_EOL;
}
die(0);
