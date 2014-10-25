<?php

namespace Monocfg;

class SettingsTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testIfEmptyPathToConfig(){
    	$settings = new Settings();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testIfBadPathToConfig(){
    	$settings = new Settings('/some/corrupted/path/');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testIfCorruptedJsonInConfig(){
    	$settings = new Settings(__DIR__ . '/configs/corrupted_config.json');
    }

    public function testCorrectPathToConfig(){
    	$settings = new Settings(__DIR__ . '/configs/correct_config.json');
    	$this->assertObjectHasAttribute('json', $settings);
    }

}