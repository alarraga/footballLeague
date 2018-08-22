FROM php:7.2-rc-alpine

RUN apk --update add \
	git openssl \
	&& rm /var/cache/apk/*

WORKDIR /home/app

ADD composer.json /home/app
ADD app/ /home/app/app

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN php composer.phar --no-plugins --no-scripts install
RUN php composer.phar run-script build-params

ADD . /home/app

CMD php bin/console server:run 0.0.0.0:3010

EXPOSE 3010
