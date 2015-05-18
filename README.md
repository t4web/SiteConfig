SiteConfig
==========

Site config module - provide key-value storage and visualization configuration

Introduction
------------

Requirements
------------

Features / Goals
----------------

Installation
------------
### Main Setup

#### By cloning project

1. Clone this project into your `./vendor/` directory.

#### With composer

1. Add this project in your composer.json:

```json
"require": {
    "t4web/site-config": "dev-master"
}
```

2. Now tell composer to download SiteConfig by running the command:

```bash
$ php composer.phar update
```

#### Post installation

1. Enabling it in your `application.config.php`file.

```php
<?php
return array(
    'modules' => array(
        // ...
        'T4webSiteConfig',
    ),
    // ...
);
```

Testing
------------
Unit test runnig from authentication module directory.
```bash
$ codeception run unit
```
For running Functional tests you need create codeception.yml in you project root, like this:
```yml
include:
    - vendor/t4web/site-config  # <- add site-config module tests to include

paths:
    log: tests/_output

settings:
    colors: true
    memory_limit: 1024M
```
After this you may run functional tests from your project root
```bash
$ codeception run
```