FROM php:8.2-apache
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
COPY index.php /var/www/html/index.php
RUN chmod 644 /var/www/html/index.php
EXPOSE 80
