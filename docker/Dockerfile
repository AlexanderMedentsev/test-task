FROM php:8.2-fpm-alpine

ARG UID
ARG GID

RUN apk --no-cache update && apk --no-cache add --update alpine-sdk && apk --no-cache add shadow

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupmod -g ${GID} www-data && usermod -u ${UID} www-data

RUN mkdir /srv/test-task

WORKDIR /srv/test-task

EXPOSE 9000

CMD ["php-fpm"]