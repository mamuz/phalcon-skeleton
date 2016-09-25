<?php

declare(strict_types = 1);

namespace PhalconSkeleton\Application\Task;

use Phalcon\Cli\Task;
use PhalconSkeleton\Application\Service\AwareTrait;

class Base extends Task
{
    use AwareTrait;
}
