FROM php:8.2

RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y zlib1g-dev \
    libzip-dev \
    git \
    cron \
    unzip

RUN docker-php-ext-install pdo pdo_mysql sockets zip

RUN echo '* * * * * cd /app && php artisan schedule:run >> /dev/null 2>&1' >> /etc/crontab
