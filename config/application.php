<?php

return [
    'dispatcher' => [
        'controllerDefaultNamespace' => 'PhalconSkeleton\Application\Controller',
        'taskDefaultNamespace'       => 'PhalconSkeleton\Application\Task',
    ],
    'routes'     => [
        'default' => [
            'pattern' => '/:controller/:action',
            'paths'   => ['controller' => 1, 'action' => 2],
        ],
    ],
    'view'       => ['templatePath' => './view'],
    'services'   => [
        'logger'       => 'PhalconSkeleton\Application\Service\Logger',
        'errorhandler' => 'PhalconSkeleton\Application\Service\ErrorHandler',
    ],
];
