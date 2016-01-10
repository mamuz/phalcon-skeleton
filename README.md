# phalcon-skeleton

## Introduction

This is a simple, skeleton application using the Phalcon2. 
This application is meant to be used as a starting place.
Its built on top of https://github.com/mamuz/phalcon-application which simplifies the bootstrap.

## Requirements

Phalcon2 is needed, follow install steps at https://github.com/phalcon/cphalcon

## Install

The easiest way to create a new project is to use Composer.

```sh
composer create-project -n -sdev mamuz/phalcon-skeleton path/to/install
```

## Changing namespace

You can change the used namespace `PhalconSkeleton` to your prefered one.

```sh
sh ./scripts/rename-namespace.sh
```

After changing namespace you have to update composer lock file and the autoloader classmap

```sh
composer update --lock
```

You should also remove the config cache file inside `./data/cache`.

## Web server setup

Check https://docs.phalconphp.com/en/latest/reference/install.html#installation-notes

# F.A.Q

## Return json header automatically for ajax calls

Add the following method in `src/Application/Controller/Base.php`:
```php
  use Phalcon\Mvc\View;

    // After route executed event
    public function afterExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher)
    {
        if($this->request->isAjax() == true) {
            $this->view->disableLevel(array(
                View::LEVEL_ACTION_VIEW => true,
                View::LEVEL_LAYOUT => true,
                View::LEVEL_MAIN_LAYOUT => true,
                View::LEVEL_AFTER_TEMPLATE => true,
                View::LEVEL_BEFORE_TEMPLATE => true
            ));

            $this->response->setContentType('application/json', 'UTF-8');
            $data = $dispatcher->getReturnedValue();

            if (is_array($data)) {
                echo json_encode($data);
            }
        }
    }
```
Your ajax methods should return an array, like:

```php
public function validateAction ()
{
  $validCode = 15;
  $isValid = false;
  $code = (int)$this->request->getPost("code");
  
  if ($code == $validCode) {
    $isValid = true;
  }
  
  return [
    'valid' => $isValid
  ];
}
```


## Access config vars inside controllers

This skeleton lets them available in `$this->config` for you.

Example:

Having this entry in `config/global.php`:
```php
  'domain' => "http://mydomain.com",
```

Inside a controller you will access it like this:
```php
<?php

namespace PhalconSkeleton\Application\Controller;

use PhalconSkeleton\Application\Helpers\Util;

class Client extends Base
{
    public function sendActivationAction()
    {
      $email = $this->request->getPost("email");
      
      // ... email validation process ...
      
      Util::sendEmail($email, "Activation details", $this->config->domain . "/activation?code=3553");
    }
}
```


## Adding a new Service

1. Create the service file in `src/Application/Service`.
2. List the new service in `config/global.php`.
 
Examples:
 Adding a MySQL adapter as service:

`src/Application/Service/Db.php`:
```php
<?php

namespace PhalconSkeleton\Application\Service;

use Phalcon\Di;
use Phapp\Application\Service\InjectableInterface;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

class Db implements InjectableInterface
{
    public static function injectTo(Di $di)
    {
        $di->setShared(
            'db',
            function () use ($di) {
                $config = $di->get('config')['db'];
                return new DbAdapter(array(
                    "host"     => $config["host"],
                    "username" => $config["username"],
                    "password" => $config["password"],
                    "dbname"   => $config["database"]
                ));
            }
        );
    }
}
```

`config/global.php`:
```php
'services'   => [
        'logger'       => 'PhalconSkeleton\Application\Service\Logger',
        'errorhandler' => 'PhalconSkeleton\Application\Service\ErrorHandler',
        'db' => 'PhalconSkeleton\Application\Service\Db',
],
'db'    => [
        'host' => 'localhost',
        'username'    => 'YOUR_USERNAME',
        'password'    => 'YOUR_PASSWORD',
        'database'    => 'YOUR_DB',
    ],
```


