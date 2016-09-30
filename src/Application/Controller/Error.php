<?php

declare(strict_types = 1);

namespace PhalconSkeleton\Application\Controller;

use Phalcon\Http\Response;

class Error extends Base
{
    public function indexAction()
    {
        if (!$this->dispatcher->wasForwarded() || !$this->dispatcher->hasParam('exception')) {
            $this->dispatcher->forward(["controller" => "index", "action" => "index"]);
            return;
        }

        /** @var \Exception $e */
        $e = $this->dispatcher->getParam('exception');
        $this->getLogger()->error($e->getMessage(), ['exception' => $e]);

        if ($e instanceof \Phalcon\Mvc\Dispatcher\Exception) {
            $response = new Response("Requested page was not found", 404, "Not Found");
        } else {
            $response = new Response("An error occurred. Please try again later.", 500, "Internal Server Error");
        }

        $this->getDI()->setShared('response', $response);
        
        return $response;
    }
}
