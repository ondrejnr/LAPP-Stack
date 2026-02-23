FROM php:8.2-fpm-alpine
# Install PostgreSQL drivers
RUN apk add --no-cache libpq-dev && docker-php-ext-install pdo_pgsql
COPY index.php /var/www/html/index.php
WORKDIR /var/www/html
