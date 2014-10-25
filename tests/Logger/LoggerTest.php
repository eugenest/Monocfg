<?php

namespace Monocfg;

class LoggerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testWithNonStringChannelName(){
    	$logger = new Logger(123, new Settings(__DIR__ . '/configs/correct_config.json'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWithWrongHandlerName(){
    	$logger = new Logger('test', new Settings(__DIR__ . '/configs/wrong_handler_name.json'));
    }

    public function testWithNameAndCorrectConfig(){
    	$logger = new Logger('test', new Settings(__DIR__ . '/configs/correct_config.json'));
    	$this->assertObjectHasAttribute('settings', $logger);
    }
}