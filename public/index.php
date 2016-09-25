<?php

set_error_handler(
    function ($severity, $message, $file, $line) {
        if (error_reporting() & $severity) {
            throw new ErrorException($message, $severity, 1, $file, $line);
        }
    }
);

chdir(dirname(__DIR__));

include './vendor/autoload.php';

Phapp\Application\Bootstrap::init(include './config/application.php')->runApplicationOn($_SERVER);
