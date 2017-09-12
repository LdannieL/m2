# m2-foggyline-helpdesk

### Installation

```sh
$ composer config repositories.koncz-m2-foggyline-helpdesk git https://github.com/ksz2013/m2-foggyline-helpdesk.git
$ composer require koncz/m2-foggyline-helpdesk:dev-master
```

Manually:

Copy the zip into app/code/Foggyline/Helpdesk directory


#### After installation by either means, enable the extension by running following commands:

```sh
$ php bin/magento module:enable Foggyline_Helpdesk --clear-static-content
$ php bin/magento setup:upgrade
```