FROM php:7
MAINTAINER adam.stipak@gmail.com

RUN apt-get update && apt-get -y upgrade && \
  apt-get install -y zlib1g-dev git
RUN docker-php-ext-install zip mbstring
RUN curl -sS https://getcomposer.org/installer |php -- --install-dir=/usr/local/bin --filename=composer

ENTRYPOINT ["/data/.docker/entrypoint.sh"]
CMD ["tests"]
