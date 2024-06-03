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

# Be sure to replace "your-domain-name.example.com" by your domain name
# ENV SERVER_NAME=your-domain-name.example.com
# If you want to disable HTTPS, use this value instead:
# ENV SERVER_NAME=:80

# Enable PHP production settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Set the working directory
WORKDIR /app

# Copy the entire project
COPY . /app

# Ensure storage and cache directories are writable
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose the default port for HTTP traffic
EXPOSE 8000

# Start the application using Octane with FrankenPHP
ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8000"]
