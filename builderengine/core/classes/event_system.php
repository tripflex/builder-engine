<?php
/***********************************************************
* BuilderEngine v2.0.12
* ---------------------------------
* BuilderEngine CMS Platform - Radian Enterprise Systems Limited
* Copyright Radian Enterprise Systems Limited 2012-2014. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2014-23-04 | File version: 2.0.12
*
***********************************************************/

    class EventManager
    {
        private static $events = array();
        private static $is_initialized = false;
        private static $is_initializing = false;

        private static $queue = array();

        public static function subscribe($event, $callback)
        {
            if(!array_key_exists($event, self::$events))
                self::$events[$event] = array();
                
            array_push(self::$events[$event], $callback);
            
            PC::EventManager("Subscribing $event -> $callback");
            PC::EventManager(self::$events);
        }
        
        public static function fire($event, &$args = array())
        {
            if(self::is_initializing())
            {
                PC::EventManager("Queuing event $event");
                $queued_event['event'] = $event;
                $queued_event['args'] = $args;
                array_push(self::$queue, $queued_event);
                return;
            }
            

            if(!array_key_exists($event, self::$events))
            {
                PC::EventManager("Event $event not found");
                return;
            }
                PC::EventManager("Yey firing");

            foreach(self::$events[$event] as $callback)
            {
                PC::EventManager("Firing event $event");
                Modules::run($callback, $args);
            }
            
                
        }

        public static function is_initialized()
        {
            return self::$is_initialized;
        }
        public static function set_initialized($bool)
        {
            self::$is_initialized = $bool;

            if($bool == true)
            {
                self::$is_initializing = false;

                PC::EventManager("Preparing to process ".count(self::$events)." elements in queue");
                foreach(self::$queue as $event)
                {
                    PC::EventManager("Processing ".$event['event']." elements in queue");
                    self::fire($event['event'], $event['args']);
                }
            }
        }

        public static function is_initializing()
        {
            return self::$is_initializing;
        }
        public static function set_initializing($bool)
        {
            self::$is_initializing = $bool;
        }

    }                        
    function add_action($event, $callback)
    {
        EventManager::register($event, $callback);    
    }
    function fire_action($event)
    {
        EventManager::fire($event); 
    }
?>
