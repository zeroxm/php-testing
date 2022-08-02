<?php

chdir(dirname(__DIR__));

define('APPLICATION_PATH', getcwd());

$config = [];
$configFiles = scandir(APPLICATION_PATH.'/conf');

$configFiles = array_filter(
    $configFiles,
    function ($val) {
        return preg_match('/^.+\.config.php$/', $val);
    }
);

foreach ($configFiles as $configFile) {
    $config = array_merge($config, include APPLICATION_PATH.'/conf/'.$configFile); 
}

$application = new Yaf_Application($config);

$application->bootstrap()->run();
?>
