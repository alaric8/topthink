
FROM  php:7.4-fpm

COPY ./ /www

WORKDIR /www

RUN  chown -R www-data:www-data /www
# 安装 PHP 扩展和必需的系统依赖
RUN apt-get update && apt-get install -y \
    libzip-dev libonig-dev unzip git && \
    docker-php-ext-install pcntl sockets pdo pdo_mysql zip && \
    pecl install redis && docker-php-ext-enable redis && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

COPY ./thinkphp.sh  /etc/local/bin/thinkphp

ENTRYPOINT [ "thinkphp" ]


