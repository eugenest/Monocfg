<?php

require '../vendor/autoload.php';

use Monocfg\Logger;
use Monocfg\Settings;

$logger = new Logger('testlog', new Settings('configs/simple_config.json'));
$logger->addInfo('test');