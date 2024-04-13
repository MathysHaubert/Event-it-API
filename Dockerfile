FROM php:8.2-apache
LABEL authors="Mathys"

RUN apt-get update && \
    apt-get install -y default-mysql-client default-libmysqlclient-dev && \
    docker-php-ext-install pdo_mysql

CMD ["apache2-foreground"]