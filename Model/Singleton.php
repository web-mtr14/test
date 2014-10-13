<?php

abstract class Model_Singleton
{
    
    private static $_instance = null;
    
    public static function getInstance()
    {
        $class = get_called_class();
        if (self::$_instance === null) {
            self::$_instance = new $class;
        }
        
        return self::$_instance;
    }
    
}
