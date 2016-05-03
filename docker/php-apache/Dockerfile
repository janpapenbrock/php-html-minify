FROM php:7.0-apache

# Xdebug
RUN pecl install xdebug-beta \
    && echo "zend_extension=xdebug.so" >> "/usr/local/etc/php/conf.d/xdebug.ini" \
    && echo xdebug.remote_enable=1 >> "/usr/local/etc/php/conf.d/xdebug.ini" \
    && echo xdebug.remote_autostart=0 >> "/usr/local/etc/php/conf.d/xdebug.ini" \
    && echo xdebug.remote_connect_back=1 >> "/usr/local/etc/php/conf.d/xdebug.ini" \
    && echo xdebug.remote_port=9000 >> "/usr/local/etc/php/conf.d/xdebug.ini" \
    && echo xdebug.remote_log=/tmp/php5-xdebug.log >> "/usr/local/etc/php/conf.d/xdebug.ini"

# Apache modules

RUN a2enmod rewrite headers
