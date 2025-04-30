FROM php:8.3.20-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
RUN docker-php-ext-configure intl && docker-php-ext-install intl

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install dependencies
RUN composer install --no-dev

# Run the laravel:setup command to publish ci4-larabridge config files
RUN php spark laravel:setup

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/writable

# Copy Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Set ServerName globally to suppress warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]