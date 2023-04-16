<?php

function connect(){
    $db = $GLOBALS['db'];
    $GLOBALS['db'] = mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database'],$db['port']);
}

function query($sql){
    return mysqli_query($GLOBALS['db'],$sql);
}

function fetch($source){
    return mysqli_fetch_array($source);
}

function all($source){
    return mysqli_fetch_all($source);
}

function qta($sql){
    return fetch(query($sql));
}

?>