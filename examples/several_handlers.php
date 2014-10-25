<?php

require '../vendor/autoload.php';

use Monocfg\Logger;
use Monocfg\Settings;

$logger = new Logger('testlog', new Settings('configs/several_handlers.json'));
$logger->addInfo('test');