FROM php:apache
WORKDIR /project
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN rm -rf /var/www/html && ln -s /project/public /var/www/html
RUN a2enmod rewrite
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_MEMORY_LIMIT=-1
RUN mkdir /composer
ENV COMPOSER_HOME /composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN chmod a+x composer.phar
RUN mv composer.phar /usr/local/bin/composer
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libpq-dev \
    libzip-dev && \
    apt-get install -y \
    git \
    unzip \
    zip \
    sqlite3 \
    openssh-client
RUN docker-php-ext-install pdo_mysql bcmath