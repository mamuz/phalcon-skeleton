<?php

declare(strict_types = 1);

namespace PhalconSkeleton\Application\Task;

use Phalcon\Cli\Task;
use PhalconSkeleton\Application\Service\AwareTrait;

/**
 * @property \Phalcon\Cli\Dispatcher $dispatcher
 */
class Base extends Task
{
    use AwareTrait;
}
