<?php

class Model_Adapter_Session extends Model_Adapter_Abstract
{
    
    public function __construct()
    {
        if (!isset($_SESSION['shop'])) {
            $_SESSION['shop'] = array();
        }
    }
    
    public function read($key)
    {
        return isset($_SESSION['shop'][$key]) ? $_SESSION['shop'][$key] : false;
    }
    
    public function save($key, array $data)
    {
        $_SESSION['shop'][$key] = $data;
        
        return true;
    }
    
    public function update($key, array $data)
    {
        if (isset($_SESSION['shop'][$key])) {
            $_SESSION['shop'][$key] = $data;
            
            return true;
        }
        
        return false;
    }
    
    public function remove($key)
    {
        if (isset($_SESSION['shop'][$key])) {
            unset($_SESSION['shop'][$key]);
            
            return true;
        }
        
        return false;
    }
    
}
