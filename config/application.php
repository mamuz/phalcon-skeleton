<?php

$config = [
    'logger' => function () {
        $logger = new \Monolog\Logger('PhalconSkeleton');
        $logger->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout'));
        return $logger;
    },
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

set_error_handler(function ($severity, $message, $file, $line) {
    if (error_reporting() & $severity) {
        throw new ErrorException($message, $severity, 1, $file, $line);
    }
});

set_exception_handler(function (\Throwable $e) use ($config) {
    $config['logger']()->error($e->getMessage(), ['exception' => $e]);
    if (php_sapi_name() == 'cli') {
        exit($e->getCode() > 0 ? (int)$e->getCode() : 1);
    }
});

return $config;
