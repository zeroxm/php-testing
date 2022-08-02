FROM php:8.1-apache

# Set the working directory to the root of the project.
RUN mkdir /app
COPY ./ /app/
WORKDIR /app

# Useful software to install.
RUN apt-get update \
    && apt-get -y install git libpq-dev unzip


RUN docker-php-ext-install pdo_pgsql

# The Yaf PHP extension.
RUN pecl install yaf
RUN docker-php-ext-enable yaf \
    && echo "Yaf.use_namespace = 1; Open namespace" >> /usr/local/etc/php/conf.d/yaf.ini \
    && echo "Yaf.use_spl_autoload=1; turn on autoload" >> /usr/local/etc/php/conf.d/yaf.ini

# Get Composer
COPY --from=composer/composer /usr/bin/composer /usr/bin/composer

# Set the symlink
RUN rm -r /var/www/html && ln -s /app/public /var/www/html

# Enable apache modules
RUN a2enmod rewrite
RUN a2enmod headers
