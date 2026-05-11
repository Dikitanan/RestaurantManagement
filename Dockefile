FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application files
COPY . .

# Set Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Clear Laravel caches
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

EXPOSE 9000

CMD ["php-fpm"]