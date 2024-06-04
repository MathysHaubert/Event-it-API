FROM php:8.2-apache
LABEL authors="Mathys"

# Update and install required packages
RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y default-mysql-client default-libmysqlclient-dev libyaml-dev wget git unzip && \
    docker-php-ext-install pdo_mysql mysqli && \
    docker-php-ext-enable pdo_mysql mysqli && \
    if ! pecl list | grep -q 'yaml'; then pecl install yaml && docker-php-ext-enable yaml; fi && \
    if [ ! -e /usr/local/etc/php/php.ini ]; then ln -s /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini; fi && \
    echo "extension=yaml.so" >> /usr/local/etc/php/php.ini && \
    a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set permissions for /var/www/html
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

CMD ["apache2ctl", "-D", "FOREGROUND"]

EXPOSE 80
