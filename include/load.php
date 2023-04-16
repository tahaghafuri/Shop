<?php
// Load Config
$config = __DIR__.'/../config/';
require_once $config.'cache.config.php';
require_once $config.'db.config.php';
// Load DB
require_once __DIR__.'/db.php';
require_once __DIR__.'/cache.php';
// DB Init
connect();
// Cache Init
cache_connect();

?>