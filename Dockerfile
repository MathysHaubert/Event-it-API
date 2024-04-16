FROM php:8.2-apache
LABEL authors="Mathys"

RUN apt-get update && \
    apt-get install -y default-mysql-client default-libmysqlclient-dev && \
    docker-php-ext-install pdo_mysql


RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql mysqli
RUN apt-get install -y libyaml-dev
RUN if ! pecl list | grep -q 'yaml'; then pecl install yaml && docker-php-ext-enable yaml; fi
RUN if [ ! -e /usr/local/etc/php/php.ini ]; then ln -s /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini; fi
RUN echo "extension=yaml.so" >> /usr/local/etc/php/php.ini
RUN a2enmod rewrite

CMD ["apache2-foreground"]

EXPOSE 80
