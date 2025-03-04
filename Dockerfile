FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip libpq-dev curl bash \
    && docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN mkdir /storage
RUN chmod 777 /storage

WORKDIR /var/www/

CMD ["php-fpm"]
