<?php

chdir(dirname(__DIR__));
include './vendor/autoload.php';
$config = require './config/application.php';

Phapp\Application\Bootstrap::init($config)->runApplicationOn($_SERVER);
