FROM ubuntu:20.04

MAINTAINER pavelzem <pzemlyanoy@yandex.ru>

RUN apt update \
    && apt install nginx -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /var/www/html

RUN rm -rf /var/www/html \
    && mkdir -p /var/www/html \
    && mkdir -p /var/www/logs

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]

