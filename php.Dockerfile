FROM arm64v8/php:7.3-apache-buster

COPY php.ini /usr/local/etc/php/php.ini
RUN apt-get update
RUN apt-get install libzip-dev -y
RUN apt-get install zip -y
RUN apt-get install vim -y
RUN apt-get install sendmail -y

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-enable zip