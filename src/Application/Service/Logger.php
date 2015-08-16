<?php

namespace PhalconSkeleton\Application\Service;

use Phalcon\Di;
use Phalcon\Logger\Multiple;
use Phapp\Application\Service\InjectableInterface;

class Logger implements InjectableInterface
{
    public static function injectTo(Di $di)
    {
        $di->setShared(
            'logger',
            function () use ($di) {
                $logger = new Multiple;
                $config = $di->get('config')['loggers'];
                foreach ($config as $logConfig) {
                    $adapter = $logConfig['adapter'];
                    $options = isset($logConfig['options']) ? $logConfig['options'] : null;
                    $logger->push(new $adapter($logConfig['name'], $options));
                }
                return $logger;
            }
        );
    }
}
