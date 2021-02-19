FROM php:7.4.15-cli-buster
MAINTAINER adam.stipak@gmail.com

RUN apt-get update && apt-get -y upgrade && apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip
RUN curl -sS https://getcomposer.org/installer |php -- --install-dir=/usr/local/bin --filename=composer

ENTRYPOINT ["/data/.docker/entrypoint.sh"]
CMD ["tests"]
