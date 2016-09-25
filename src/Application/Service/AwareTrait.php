<?php

declare(strict_types = 1);

namespace PhalconSkeleton\Application\Service;

/**
 * Trait is only usable for classes implementing \Phalcon\Di\InjectionAwareInterface
 */
trait AwareTrait
{
    /**
     * @return \Phalcon\Di\InjectionAwareInterface
     */
    private function getInstance()
    {
        return $this;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    protected function getLogger()
    {
        return $this->getInstance()->getDI()->get('logger');
    }

    /**
     * @return \Phalcon\Config
     */
    protected function getConfig()
    {
        return $this->getInstance()->getDI()->get('config');
    }
}
