<?php
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
