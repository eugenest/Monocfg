<?php

namespace Monocfg;
/**
 * Wrapper class to configure Monolog loggers via json config files
 * @author Eugene Timofieiev <eugene.timofieiev@gmail.com>
 * @example see at examples folder
 */
class Logger extends \Monolog\Logger
{ 
    /**
     * Prefix to monolog handlers
     */
    const HANDLERS_PREFIX = "\Monolog\Handler\\";

    /**
     * Monolog Handlers list 
     * @var object
     */
    private $settings;

    /**
     * Builds Monolog\Logger data with set of handlers given in configuration file.
     * @param string $channelName Name of logging channel
     * @param Settings $settings object with json-formatted config
     * @throws InvalidArgumentException if $channelName is not a string
     * @todo check handler parameters compatibility
     */
    function __construct($channelName, Settings $settings){
        if (!is_string($channelName)){
            throw new \InvalidArgumentException('Channel name should be a string');   
        }

        parent::__construct($channelName);

        $this->settings = $settings;
        $this->attachHandlers();
    }

    /**
     * Attaches handlers to logger
     * @throws InvalidArgumentException if non-existing handlers trying in config
     */
    private function attachHandlers(){
        foreach($this->settings->json as $handlerName => $handlerParameters){
            
            $handlerClassName = self::HANDLERS_PREFIX . $handlerName;
            
            if (!class_exists($handlerClassName)){
                throw new \InvalidArgumentException("Handler $handlerClassName does now exists, check config.");
            }

            $handlerClass = new \ReflectionClass($handlerClassName);
            $handlerInstance = $handlerClass->newInstanceArgs($handlerParameters);
            
            $this->pushHandler($handlerInstance);
        }
    }
}