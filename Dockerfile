FROM dunglas/frankenphp

# Install PHP extensions
RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    opcache \
    pcntl \
    bcmath \
    sockets

# Enable PHP production settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Install Node.js and npm (latest LTS version)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /app

# Copy the entire project except items in .dockerignore
COPY . .

# Ensure storage and cache directories are writable
RUN chown -R www-data:www-data storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Run Artisan commands
RUN php artisan package:discover --ansi \
    && php artisan filament:upgrade \
    && php artisan vendor:publish --tag=laravel-assets --ansi --force

# post-autoload-dump
#php artisan package:discover --ansi \
# && php artisan filament:upgrade \
# post-update-cmd
# php artisan vendor:publish --tag=laravel-assets --ansi --force

# Install Node.js dependencies
RUN npm install

# Expose the default port for HTTP traffic
EXPOSE 8000

# Start the application using Octane with FrankenPHP
ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8000"]
