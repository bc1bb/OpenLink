# Build Stage
FROM node:20-bullseye AS BUILD_IMAGE
WORKDIR /build
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Production Stage
FROM php:8.2-fpm-bullseye

RUN apt-get update && apt-get install -y libzip-dev unzip curl git \
    && docker-php-ext-install zip pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY --from=BUILD_IMAGE /build/package*.json ./
COPY --from=BUILD_IMAGE /build/public ./public
COPY --from=BUILD_IMAGE /build/node_modules ./node_modules
COPY . .

RUN composer install

RUN php bin/console doctrine:migrations:migrate

CMD ["php-fpm"]