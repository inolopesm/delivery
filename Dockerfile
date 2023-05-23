FROM php:5.6-cli

RUN docker-php-ext-install mysql
RUN docker-php-ext-enable mysql
