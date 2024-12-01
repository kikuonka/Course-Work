FROM php:8.3-apache

RUN apt-get update && apt-get install -y  libpng-dev libjpeg-dev libfreetype6-dev && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd pdo pdo_mysql mysqli
RUN pecl install redis
RUN docker-php-ext-enable redis

COPY ./app /var/www/html/
COPY apache.conf /etc/apache2/sites-available/000-default.conf
COPY php.ini /usr/local/etc/php/php.ini

RUN a2enmod rewrite
RUN service apache2 restart
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
