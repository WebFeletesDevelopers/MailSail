FROM php:7.4-alpine

RUN apk add --no-cache $PHPIZE_DEPS \
  && pecl install xdebug-2.9.1 \
  && docker-php-ext-enable xdebug \
  && apk del $PHPIZE_DEPS

WORKDIR /
RUN curl https://getcomposer.org/installer -o composer-install.php \
  && php composer-install.php --install-dir=/usr/local/bin --filename="composer" \
  && rm composer-install.php

WORKDIR /app