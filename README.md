# phalcon-skeleton

## Introduction

This is a simple, skeleton application using Phalcon3 Framework. 
This application is meant to be used as a starting place.
It's built on top of https://github.com/mamuz/phalcon-application which simplifies application bootstrapping.

## Requirements

PHP7 and Phalcon3 is needed, follow install steps at https://github.com/phalcon/cphalcon

## Install

### Step 1: Create new project with composer
 
```sh
composer create-project -n -sdev mamuz/phalcon-skeleton path/to/install
```

### Step 2: Customize new project to your needs

Run `./bin/customize.sh` inside application root to customize the project.

It will ask you for assigning following changes:

1. `Enter the new classnamespace identifier to use`:
Composer Autoloader is mapping as `"autoload": {"psr-4": {"PhalconSkeleton\\": "src/"}}`
e.g customizing the identifier to `Autoloader` will lead to `"autoload": {"psr-4": {"Application\\": "src/"}}`,
according to that all FQCN of all classes will be changed.

2. `Enter composer namespace`:
Composer project name is defined as `"name": "mamuz/phalcon-skeleton"`
e.g. customizing the namespace to `user/application` leads to `"name": "user/application"`

3. `Enter a short project description`:
This text is used for prepared README.md and will be placed as `description` value inside `composer.json`

4. `Enable view support?`:
If support is desired, application config will be prepared and in addition you will have example view templates.

## How To's

Please check https://github.com/mamuz/phalcon-application for detailed informations about bootstrapping.
For Phalcon usages in general please visit https://docs.phalconphp.com.
