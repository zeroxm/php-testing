FROM php

RUN pecl install yaf

COPY --from=composer/composer /usr/bin/composer /usr/bin/composer

RUN mkdir /app

COPY ./ /app/

RUN cp "/app/ci/php.ini" "$PHP_INI_DIR/php.ini"
