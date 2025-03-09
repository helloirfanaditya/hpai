FROM php:8.3-fpm-alpine

LABEL maintainer="helloirfanaditya <github.com/helloirfanaditya>"

RUN apk update && apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql bcmath mbstring opcache \
    && rm -rf /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /repository

COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8001

CMD ["php-fpm"]
