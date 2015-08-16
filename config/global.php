<?php

return [
    'dispatcher' => [
        'controllerDefaultNamespace' => 'PhalconSkeleton\Application\Controller',
        'taskDefaultNamespace'       => 'PhalconSkeleton\Application\Task',
        'errorForwarding'            => [
            'controller'     => 'error',
            'notFoundAction' => 'notFound',
            'errorAction'    => 'fatal',
        ],
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
        'logger' => 'PhalconSkeleton\Application\Service\Logger',
    ],
    'loggers'    => [
        'file' => [
            'adapter' => 'Phalcon\Logger\Adapter\File',
            'name'    => './data/log/error.log',
        ],
    ],
];
