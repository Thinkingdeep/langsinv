<?php
error_reporting(1);

//'mysql' => array(
//        'host' => '127.0.0.1',
//        'username' => 'root',
//        'password' => 'GetIn2016',
//        'db' => 'mds'
//    ),

//session_start();
$GLOBALS['config'] = array(
    
    'mysql' => array(
         'host' => '127.0.0.1',
         'username' => 'root',
         'password' => '',
         'db' => 'new_langas_db'
     ),
     
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);
//require_once 'classes/config.php';
//require_once 'classes/config.php';
//require_once 'classes/config.php';
spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.php';
});
require_once 'functions/functions.php';
?>