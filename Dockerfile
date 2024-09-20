
FROM  php:7.4-fpm



COPY ./thinkphp.sh  /usr/local/bin/thinkphp

RUN  chmod +x   /usr/local/bin/thinkphp

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



RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 确认 Composer 安装成功
RUN composer --version

USER www-data:www-data

RUN  composer install 

RUN mkdir -p /public/storage 

EXPOSE 9000

EXPOSE 1236  
# websocket 
EXPOSE 2348


CMD [ "thinkphp"]


