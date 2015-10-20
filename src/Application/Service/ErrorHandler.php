<?php

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
            function (Event $event, Dispatcher $dispatcher, \Exception $e) {
                /** @var \Phalcon\Logger\AdapterInterface $logger */
                $logger = $dispatcher->getDI()->get('logger');
                $logger->error($e->getMessage());
                if ($dispatcher instanceof Mvc\Dispatcher) {
                    if ($e instanceof Mvc\Dispatcher\Exception) {
                        $action = 'notFound';
                    } else {
                        $action = 'fatal';
                        if ($dispatcher->getDI()->has('response')) {
                            /** @var \Phalcon\Http\Response $response */
                            $response = $dispatcher->getDI()->get('response');
                            $response->setStatusCode(500, "Internal Server Error");
                        }
                    }
                    $dispatcher->setNamespaceName($dispatcher->getDefaultNamespace());
                    $dispatcher->forward(['controller' => 'error', 'action' => $action]);
                }
                return false;
            }
        );
    }
}
