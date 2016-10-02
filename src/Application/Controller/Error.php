<?php

declare(strict_types = 1);

namespace PhalconSkeleton\Application\Controller;

use Phalcon\Http\Response;

class Error extends Base
{
    public function indexAction()
    {
        if (!$this->dispatcher->wasForwarded()
            || $this->dispatcher->getParam('exception') instanceof \Phalcon\Mvc\Dispatcher\Exception
        ) {
            return new Response("Requested page was not found", 404, "Not Found");
        }

        /** @var \Exception $e */
        $e = $this->dispatcher->getParam('exception');
        $this->getLogger()->error($e->getMessage(), ['exception' => $e]);
        
        return new Response("An error occurred. Please try again later.", 500, "Internal Server Error");
    }
}
