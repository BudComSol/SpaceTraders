# Author: Pfahli
# Version: 0.2
# Project: ultimateXnova

# Use the PHP image with Apache
FROM php:8.3-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo_mysql

# Install GD library
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd