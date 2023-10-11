# Build Stage
FROM node:20-bullseye AS BUILD_IMAGE

ENV NODE_ENV production
WORKDIR /build
COPY packag*.json ./
RUN npm install --include=dev
COPY . .
RUN npm run build

# Production Stage
FROM php:8.2-apache-bullseye

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV SYMFONY_ENV prod

RUN apt-get update && apt-get install -y libzip-dev unzip curl git \
    && docker-php-ext-install zip pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY --from=BUILD_IMAGE /build/package*.json ./
COPY --from=BUILD_IMAGE /build/public ./public
COPY . .
COPY ./apache2.conf /etc/apache2/sites-enabled/000-default.conf

RUN composer install --no-dev --optimize-autoloader \
    && composer dump-env prod

CMD ["apache2-foreground"]
EXPOSE 80