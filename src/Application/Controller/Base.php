<?php

declare(strict_types = 1);

namespace PhalconSkeleton\Application\Controller;

use Phalcon\Mvc\Controller;
use PhalconSkeleton\Application\Service\AwareTrait;

class Base extends Controller
{
    use AwareTrait;
}
