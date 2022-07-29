#!/usr/bin/env bash


export APP_ENV=dev
composer install;
php /var/www/html/bin/magento setup:install
