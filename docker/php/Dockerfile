FROM php:8.5-fpm-bookworm

ENV CFLAGS="$CFLAGS -D_GNU_SOURCE"

RUN apt-get update \
    && apt-get install -y --no-install-recommends  \
    wkhtmltopdf  \
    libmcrypt-dev  \
    libpq-dev  \
    libzip-dev  \
    zlib1g-dev  \
    libxml2-dev  \
    cpio  \
    sqlite3  \
    libsqlite3-dev  \
    unzip  \
    git  \
    sendmail \
    libmagickwand-dev  \
    libcurl4-openssl-dev \
    gosu

RUN apt-get install -y libmagickwand-dev; \
    pecl install imagick; \
    docker-php-ext-enable imagick; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j$(nproc) gd;

RUN docker-php-source extract \
    && docker-php-ext-install bcmath pdo_pgsql pdo_mysql pdo_sqlite soap sockets zip exif iconv pdo_pgsql pgsql \
    && pecl install redis \
    && pecl install trader \
    && docker-php-ext-enable redis \
    && docker-php-ext-enable trader \
    && docker-php-source delete \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install pdo_mysql;

RUN pecl install --configureoptions 'enable-sockets="no" enable-openssl="yes" enable-http2="yes" enable-mysqlnd="yes" enable-swoole-json="no" enable-swoole-curl="yes"' swoole \
    && docker-php-ext-enable swoole

WORKDIR /opt/app/src

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && rm composer-setup.php

RUN rm -rf /var/lib/apt/lists/*

ADD php.ini /usr/local/etc/php/conf.d/php.ini
ADD www.conf /usr/local/etc/php-fpm.d/www.conf
ADD php-fpm.conf /usr/local/etc/php-fpm.conf

RUN sed -i '/#!\/bin\/sh/achown -R www-data:www-data storage/' /usr/local/bin/docker-php-entrypoint
RUN sed -i '/#!\/bin\/sh/achmod -R g+s storage/' /usr/local/bin/docker-php-entrypoint


#RUN sed -i '/#!\/bin\/sh/aservice sendmail restart' /usr/local/bin/docker-php-entrypoint



