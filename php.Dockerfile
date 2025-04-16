FROM php:8.0.30-apache-buster

COPY php.ini /usr/local/etc/php/php.ini
COPY ./phoenixcart /var/www/html

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    vim \
    sendmail

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-enable zip

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod 777 /var/www/html/includes/configure.php /var/www/html/admin/includes/configure.php