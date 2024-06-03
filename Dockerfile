FROM dunglas/frankenphp

# Be sure to replace "your-domain-name.example.com" by your domain name
ENV SERVER_NAME=cassinobles.com
# If you want to disable HTTPS, use this value instead:
#ENV SERVER_NAME=:80

ENV FRANKENPHP_CONFIG="worker ./public/index.php"

# Enable PHP production settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# If you use Symfony or Laravel, you need to copy the whole project instead:
COPY . /app

ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
