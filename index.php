<?php

error_reporting(-1);

define('ROOT', realpath('.'));
define('DS', DIRECTORY_SEPARATOR);

class Boot
{
    
    public function init()
    {
        session_start();
        
        spl_autoload_register(function ($class) {
            require_once(ROOT . DS . join(DS, explode('_', $class)) . '.php');
        });
        
        return $this;
    }
    
    public function run()
    {
        $content = Model_Content::getInstance()->setAdapter('session');
        if (!($order = $content->read('order'))) {
            $order = array();
        }
        
        if (!empty($_POST['ajax'])) {
            if (!empty($_POST['id']) && $_POST['id'] = (int) $_POST['id']) {
                $order[$_POST['id']] = array('id' => $_POST['id']);
                
                $content->save('order', $order);
                $order = array('count' => count($order));
            } else if ($_POST['ajax'] == 'clear') {
                $content->remove('order');
                $order = array('status' => 1);
            }
            header('Content-Type: application/json');
            die(json_encode($order));
        }
        
        if (!($items = $content->read('items'))) {
            $items = array(
                array('id' => 1, 'name' => 'name 1'),
                array('id' => 2, 'name' => 'name 2'),
                array('id' => 3, 'name' => 'name 3')
            );
            $content->save('items', $items);
        }
        
        foreach ($items as $index => &$item) {
            if (isset($order[$item['id']])) {
                $item = '';
            } else {
                $item = sprintf('<div class="items" id="item_%u" style="background:#%s;padding10px;cursor:pointer;width:1000px;padding:10px;border: 1px solid #444;margin-bottom:5px;">%s</div>', $item['id'], $index % 2 == 0 ? 'eee' : 'fff', $item['name']);
            }
        }
        unset($item);
        
        $order = count($order);
        
        header('Content-Type: text/html; charset=utf-8');
        echo str_replace(
            array('{{ title }}', '{{ count }}', '{{ content }}'),
            array('Shopping Cart', $order == 0 ? 'no' : $order, join('', $items)),
            file_get_contents(ROOT . DS . 'View' . DS . 'index.tpl')
        );
    }
    
}

$inst = new Boot;
$inst
    ->init()
    ->run();
