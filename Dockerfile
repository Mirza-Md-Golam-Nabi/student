# Use the official PHP Apache base image
FROM php:8.0-apache

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        curl

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy project files to the container
COPY . /var/www/html

# Set file permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Set the entry point for the container
ENTRYPOINT [ "php", "artisan", "serve", "--host=0.0.0.0" ]
