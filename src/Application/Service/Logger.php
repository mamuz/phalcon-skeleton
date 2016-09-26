<?php

declare(strict_types = 1);

namespace PhalconSkeleton\Application\Service;

use Phalcon\Di;
use Phapp\Application\Service\InjectableInterface;

class Logger implements InjectableInterface
{
    public static function injectTo(Di $di)
    {
        $di->setShared(
            'logger',
            function () use ($di) {
                $logger = new \Monolog\Logger('PhalconSkeleton');
                $logger->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout'));
                return $logger;
            }
        );
    }
}
