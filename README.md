SiteConfig
==========

ZF2 Module. Site config module - provide key-value configuration.

Installation
------------
### Main Setup

#### By cloning project

Clone this project into your `./vendor/` directory.

#### With composer

2. Now tell composer to download SiteConfig by running the command:

```bash
$ composer require t4web/site-config:"~2.0.0"
```

3. Create tables by initial script:

```bash
$ php public/index.php site-config init
```

#### Post installation

1. Enabling it in your `application.config.php`file.

```php
<?php
return array(
    'modules' => array(
        // ...
        'T4web\SiteConfig',
    ),
    // ...
);
```

Quick start
-----------
Insert scopes and values to tables `site_config_values` and `site_config_scopes`:

```sql
INSERT INTO `site_config_scopes` (`id`, `name`) 
VALUES (1, 'products');

INSERT INTO `site_config_values` (`id`, `scope_id`, `name`, `value`) 
VALUES (1, 1, 'items-per-page', 20);
```

Use it anywhere

```php
$siteConfig = $serviceLocator->get("T4web\SiteConfig\Config");
$siteConfig->get('items-per-page', 'products');
//...
$siteConfig->set('items-per-page', 'products', 10);
```
