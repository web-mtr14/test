<?php

abstract class Model_Adapter_Abstract
{
    
    abstract public function read($key);
    
    abstract public function save($key, array $data);
    
    abstract public function update($key, array $data);
    
    abstract public function remove($key);
    
}
