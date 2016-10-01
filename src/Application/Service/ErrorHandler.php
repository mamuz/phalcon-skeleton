<?php

declare(strict_types = 1);

namespace PhalconSkeleton\Application\Service;

use Phalcon\Di;
use Phalcon\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Mvc;
use Phapp\Application\Service\InjectableInterface;

class ErrorHandler implements InjectableInterface
{
    public static function injectTo(Di $di)
    {
        /** @var Dispatcher $dispatcher */
        $dispatcher = $di->getShared('dispatcher');
        $dispatcher->getEventsManager()->attach(
            'dispatch:beforeException',
            function (Event $event, Dispatcher $dispatcher, \Throwable $e) {
                if ($dispatcher instanceof Mvc\Dispatcher) {
                    $dispatcher->setNamespaceName($dispatcher->getDefaultNamespace());
                    $dispatcher->forward([
                        'controller' => 'error',
                        'action'     => 'index',
                        'params'     => ['exception' => $e],
                    ]);
                } else {
                    /** @var \Psr\Log\LoggerInterface $logger */
                    $logger = $dispatcher->getDI()->get('logger');
                    $logger->error($e->getMessage(), ['exception' => $e]);
                }

                return false;
            }
        );
    }
}
