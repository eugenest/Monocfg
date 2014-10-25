<?php

namespace Monocfg;

/**
 * Gets settings from json files. If passed string leads to non-existing file, triggers warning and gets default config.
 * Config items should be equal to Monolog Handlers signatures, see https://github.com/Seldaek/monolog/tree/master/src/Monolog/Handler, or magic will not happen
 * @author Eugene Timofieiev <eugene.timofieiev@gmail.com>
 * @example of config files see at examples/configs/ folder
 * @todo Because json_decode always uses last key in case of duplicated keys, there is no ability to duplicate handlers now. Should fix it.
 */
class Settings
{
    /**
     * path to config file
     * @var string
     */
    private $path;
    /**
     * raw string from settings file
     * @var string
     */
    private $raw;

    /**
     * formatted json object of settings
     * @var mixed
     */
    public $json;
    
    /**
     * Builds settings object from config files and assigns items to object properties
     * @param string $settingsFilePath path to config file.
     * @throws InvalidArgumentException if $settingsFilePath is null
     * @throws InvalidArgumentException if $settingsFilePath file not exists
     */
    function __construct($settingsFilePath = null){
        if (is_null($settingsFilePath)){
            throw new \InvalidArgumentException("You should set path to config");
        }
        if (!file_exists($settingsFilePath)){
            throw new \InvalidArgumentException("Could not open file $settingsFilePath");
        }

        $this->path = $settingsFilePath;
		$this->getConfigAsJson();
    }

    /**
     * Loads raw json string from settings file
     * @throws InvalidArgumentException if reading file fails
     */
    private function loadConfigFile(){
        $this->raw = file_get_contents($this->path);
        if (!$this->raw){
            throw new \Exception('Error while reading file.');
        }
    }
    
    /**
     * Parses JSON from raw string of config
     * @throws InvalidArgumentException in case of invalid JSON in config file
     */
    private function getConfigAsJson(){
        $this->loadConfigFile();
        
        $this->json = json_decode($this->raw);
        
        if (is_null($this->json)){
			throw new \InvalidArgumentException("Parsing error. File {$this->path} exists, but contains invalid data");
		}
    }
}