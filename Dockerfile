FROM php:7.2-apache

ENV APACHE_DOCUMENT_ROOT /var/www/statflo/public

WORKDIR /var/www/statflo/

RUN apt-get update -y && \
    apt-get install -y openssl zip unzip git

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo mbstring

COPY ./ /var/www/statflo/

RUN composer install