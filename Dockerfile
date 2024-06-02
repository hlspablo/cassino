# Use the official PHP image with Alpine
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apk update && apk add --no-cache \
    autoconf \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    curl \
    bash \
    git \
    supervisor \
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache \
    && pecl install redis \
    && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents and set permissions
COPY --chown=www-data:www-data . /var/www

# Set permissions for Laravel directories
RUN chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Copy Nginx configuration file
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx/default.conf /etc/nginx/nginx.conf

# Setup Supervisor to manage services
RUN mkdir -p /etc/supervisor/conf.d
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Download and configure Cloud SQL Proxy
# RUN curl -o /cloud_sql_proxy https://dl.google.com/cloudsql/cloud_sql_proxy.linux.amd64 \
#     && chmod +x /cloud_sql_proxy

# Expose ports
EXPOSE 80

# Start all services
CMD ["/usr/bin/supervisord"]
