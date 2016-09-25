<?php

declare(strict_types = 1);

namespace PhalconSkeleton\Application\Controller;

class Error extends Base
{
    public function indexAction()
    {
        if (!$this->dispatcher->hasParam('exception')) {
            $this->dispatcher->forward('index', 'index');
            return;
        }

        /** @var \Exception $e */
        $e = $this->dispatcher->getParam('exception');
        $this->getLogger()->error($e->getMessage(), ['exception' => $e]);

        if ($e instanceof \Phalcon\Mvc\Dispatcher\Exception) {
            $this->response->setStatusCode(404, "Not Found");
        } else {
            $this->response->setStatusCode(500, "Internal Server Error");
        }
    }
}
