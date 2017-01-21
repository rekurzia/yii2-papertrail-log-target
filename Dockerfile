FROM php:7.0

RUN apt-get update -q \
  && apt-get install unzip git --no-install-recommends -y

RUN docker-php-ext-install sockets

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer

RUN mkdir -p /code
WORKDIR /code
