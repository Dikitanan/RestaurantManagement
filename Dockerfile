FROM php:8.2-fpm

# Install system dependencies
# Added libpq-dev (required for Postgres)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy all files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Create necessary framework folders and fix permissions
# This ensures Laravel can write logs, sessions, and compiled views
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Render needs an HTTP port
EXPOSE 8080

# Start Laravel as HTTP server
# Note: In production, consider using a 'Start Command' in Render dashboard 
# to run 'php artisan migrate --force' before starting the server.
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}