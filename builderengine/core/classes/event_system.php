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

        public static function register($event, $callback)
        {
            if(!array_key_exists($event, self::$events))
                self::$events[$event] = array();
                
            array_push(self::$events[$event], $callback);
                
        }
        
        public static function fire($event)
        {
            if(!array_key_exists($event, self::$events))
                return;
            
            foreach(self::$events[$event] as $callback)
            {
                call_user_func($callback);
            }
                
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
