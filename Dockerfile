FROM php:apache-bullseye

WORKDIR /var/www/

# Tailwind
RUN apt-get update && apt-get update
RUN apt-get install -y curl git
RUN curl https://raw.githubusercontent.com/mklement0/n-install/stable/bin/n-install | bash  -s -- -y lts
ENV PATH=$PATH:/root/n/bin
RUN npm install
RUN npx tailwindcss -o build.css --minify

# PHP-Mysql
RUN apt-get install php-mysql
RUN docker-php-ext-install mysqli

# Composer
RUN wget https://getcomposer.org/download/2.5.8/composer.phar
RUN mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer
RUN composer install

# Cleanup
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /root/n/ ./node_modules

# Apache
RUN a2enmod rewrite
CMD ["apache2-foreground"]

EXPOSE 80