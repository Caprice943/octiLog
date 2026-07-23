FROM php:8.4-fpm-alpine

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) pdo_mysql intl opcache zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-interaction --prefer-dist

COPY . .
RUN composer dump-autoload --optimize

RUN mkdir -p public/uploads/montures var/cache var/log \
    && chown -R www-data:www-data var public/uploads

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
