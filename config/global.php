<?php

return [
    'dispatcher' => [
        'controllerDefaultNamespace' => 'PhalconSkeleton\Application\Controller',
        'taskDefaultNamespace'       => 'PhalconSkeleton\Application\Task',
    ],
    'view'       => [
        'templatePath' => './view/',
    ],
    'routes'     => [
        'default' => [
            'pattern' => '/:controller/:action',
            'paths'   => [
                'controller' => 1,
                'action'     => 2,
            ],
        ],
    ],
    'services'   => [
        'logger'       => 'PhalconSkeleton\Application\Service\Logger',
        'errorhandler' => 'PhalconSkeleton\Application\Service\ErrorHandler',
    ],
    'loggers'    => [
        'file' => [
            'adapter' => 'Phalcon\Logger\Adapter\File',
            'name'    => './data/log/error.log',
        ],
    ],
];
