FROM ubuntu:20.04

MAINTAINER pavelzem <pzemlyanoy@yandex.ru>

RUN apt update \
    && apt install -y \
        software-properties-common \
        curl \
        zip \
        less \
    && rm -rf /var/lib/apt/lists/*

RUN add-apt-repository ppa:ondrej/php -y \
    && apt update \
    && apt install -y \
        php7.4 \
        php7.4-cli \
        php7.4-fpm \
        php7.4-opcache \
        php7.4-curl \
        php7.4-mbstring \
        php7.4-xml \
        php7.4-simplexml \
        php7.4-json \
        php7.4-zip \
        php7.4-phar \
        php7.4-tokenizer \
        php7.4-fileinfo \
        php7.4-gd \
        php7.4-mysqli \
        php7.4-common \
        php7.4-pdo \
        php7.4-iconv \
        php7.4-fileinfo \
        php7.4-xmlwriter \
        php7.4-ctype \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir /var/run/php && chmod 777 -R /var/run/php;

RUN mkdir -p /var/www/html

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

CMD ["php-fpm7.4", "-F"]
