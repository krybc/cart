FROM php:7.3-apache

# OS dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    zlib1g-dev \
    libpq-dev \
    zlib1g \
    git \
    unzip \
    libzip-dev \
    nano

# PHP dependencies
RUN docker-php-ext-install \
    intl \
    mbstring \
    pdo \
    pdo_mysql \
    exif \
    zip

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Warsaw /etc/localtime
RUN "date"

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Apache
ADD 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# RUN usermod -u 1000 www-data

WORKDIR /var/www

EXPOSE 80