# Use official PHP 8.2 with Apache
FROM php:8.2-apache

# Enable needed PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy project files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install composer
RUN apt-get update && apt-get install -y zip unzip git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
