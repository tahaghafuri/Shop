<?php

if ($GLOBALS['cache']=='redis') {
    function cache_connect()
    {
        $GLOBALS['redis'] = new Redis();
        $GLOBALS['redis']->connect($GLOBALS['cache']['host'], $GLOBALS['cache']['port']);
        return $GLOBALS['redis']->ping();
    }

    function cache_create($name, $value)
    {
        return $GLOBALS['redis']->set($name, $value);
    }

    function cache_read($name){
        return $GLOBALS['redis']->get($name);
    }
}elseif($GLOBALS['cache']=='mamcached'){
    function cache_connect()
    {
        $GLOBALS['memcache'] = new Memcache();
        $GLOBALS['memcache']->connect($GLOBALS['cache']['host'], $GLOBALS['cache']['port']);
        return $GLOBALS['memcache']->ping();
    }

    function cache_create($name, $value)
    {
        return $GLOBALS['memcache']->set($name, $value, false, 500);
    }

    function cache_read($name){
        return $GLOBALS['memcache']->get($name);
    }
}else{
    function cache_connect()
    {
        return $GLOBALS['cache'] = [];
    }

    function cache_create($name, $value)
    {
        return $GLOBALS['cache'][$name] = $value;
    }

    function cache_read($name){
        return $GLOBALS['cache'][$name];
    }
}

?>