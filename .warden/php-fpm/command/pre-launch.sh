#!/usr/bin/env bash


export APP_ENV=prod
composer install;
php /var/www/html/bin/magento setup:install
