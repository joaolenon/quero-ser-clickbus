<?php

require "vendor/autoload.php";

$value = filter_var($argv[1], FILTER_VALIDATE_INT);

$machine = new Cash\Machine;
$notes = $machine->withdraw($value);

echo implode(",", $notes) . PHP_EOL;
