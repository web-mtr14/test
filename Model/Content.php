<?php

class Model_Content extends Model_Singleton
{
    
    private $_adapter = null;
    
    protected function __construct()
    {
        
    }
    
    public function setAdapter($adapter = 'session')
    {
        $adapter = 'Model_Adapter_' . ucfirst(strtolower($adapter));
        $this->_adapter = new $adapter;
        
        return $this;
    }
    
    public function read($key)
    {
        return $this->_adapter->read($key);
    }
    
    public function save($key, array $data)
    {
        return $this->_adapter->save($key, $data);
    }
    
    public function update($key, array $data)
    {
        return $this->_adapter->update($key, $data);
    }
    
    public function remove($key)
    {
        return $this->_adapter->remove($key);
    }
    
}
