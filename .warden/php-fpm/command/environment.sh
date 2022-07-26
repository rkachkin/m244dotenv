#!/usr/bin/env bash

php /var/www/html/bin/magento deploy:mode:set developer;
php /var/www/html/bin/magento c:f;
