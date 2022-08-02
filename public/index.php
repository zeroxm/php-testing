<?php

chdir(dirname(__DIR__));

define('APPLICATION_PATH', getcwd());

$config = include APPLICATION_PATH."/conf/application.config.php";

$application = new Yaf_Application($config);

$application->bootstrap()->run();
?>
