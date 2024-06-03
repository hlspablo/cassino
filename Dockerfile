FROM dunglas/frankenphp

RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    opcache \
    pcntl \
    bcmath

# Enable PHP production settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Set workdir
WORKDIR /app

# Copy the entire project except items in .dockerignore
COPY . .

# Run optimizations
RUN php artisan package:discover --ansi \
    && php artisan filament:upgrade \
    && php artisan vendor:publish --tag=laravel-assets --ansi --force \
    && php artisan optimize:clear

# Expose the default port for HTTP traffic
EXPOSE 8000

# Start the application using Octane with FrankenPHP
ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8000"]
