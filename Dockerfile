FROM php:apache
WORKDIR /project
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN rm -rf /var/www/html && ln -s /project/public /var/www/html
RUN a2enmod rewrite