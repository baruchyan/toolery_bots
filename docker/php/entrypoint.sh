#!/bin/bash

chown -R www-data:www-data storage/
echo "sendmail_path=/usr/sbin/sendmail -t -f noreply@${APP_DOMAIN} -i" >> /usr/local/etc/php/conf.d/sendmail.ini
service sendmail restart
php-fpm