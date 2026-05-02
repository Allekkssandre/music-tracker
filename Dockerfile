FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

RUN composer install

EXPOSE 8000

RUN php bin/console doctrine:migrations:migrate --no-interaction || true

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]