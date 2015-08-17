<?php

namespace Phpg\Application\Service;

use Phalcon\Di;
use Phalcon\Dispatcher as PhalconDispatcher;
use Phalcon\Events\Event;
use Phalcon\Mvc;
use Phapp\Application\Service\InjectableInterface;

class Dispatcher implements InjectableInterface
{
    public static function injectTo(Di $di)
    {
        /** @var \Phalcon\Mvc\Dispatcher $dispatcher */
        $dispatcher = $di->getShared('dispatcher');
        $dispatcher->getEventsManager()->attach(
            'dispatch:beforeException',
            function (Event $event, PhalconDispatcher $dispatcher, \Exception $e) {
                $logger = $dispatcher->getDI()->get('logger');
                $logger->error($e->getMessage());
                if ($dispatcher instanceof \Phalcon\Mvc\Dispatcher) {
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
