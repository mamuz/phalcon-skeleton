<?php

chdir(dirname(__DIR__));

include './vendor/autoload.php';

$env = trim(file_get_contents('./ENV'));
$configCache = './data/cache/config.php';

Phapp\Application\Bootstrap::init($env, $env === 'development' ? null : $configCache)->runApplicationOn($_SERVER);
