FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip

RUN docker-php-ext-install pdo_mysql zip

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --optimize-autoloader --no-dev

EXPOSE 80

CMD ["apache2-foreground"]
