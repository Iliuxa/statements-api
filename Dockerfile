FROM php:8.2-fpm

# Устанавливаем необходимые пакеты
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev curl bash \
    && docker-php-ext-install pdo pdo_pgsql

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем Symfony CLI (исправленная команда)
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/

CMD ["php-fpm"]
