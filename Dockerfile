FROM php:apache-bullseye

COPY --chown=www-data:www-data . /var/www/
COPY apache2.conf /etc/apache2/sites-enabled/000-default.conf
WORKDIR /var/www/

# Building
RUN apt-get update && \
    apt-get install -y curl git libpng-dev libonig-dev libxml2-dev zip unzip
RUN curl https://raw.githubusercontent.com/mklement0/n-install/stable/bin/n-install | bash  -s -- -y lts
ENV PATH=$PATH:/root/n/bin
ENV NODE_ENV=production
RUN npm install &&  \
    npx tailwindcss -o public/css/build.css --minify

# Setup PHP exts
RUN docker-php-ext-install pdo_mysql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cleanup
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /root/n/ ./node_modules

# Symfony
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV STABILITY=stable
RUN composer require symfony/flex && composer require symfony/runtime
RUN php bin/console cache:clear

# Apache
RUN a2enmod rewrite
CMD ["apache2-foreground"]

EXPOSE 80