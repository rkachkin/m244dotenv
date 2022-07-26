#!/usr/bin/env bash

php /var/www/html/bin/magento deploy:mode:set "${APP_ENV:=developer}"
