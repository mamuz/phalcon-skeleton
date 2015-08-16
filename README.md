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
