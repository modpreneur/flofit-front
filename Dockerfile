FROM php:5.6-apache

MAINTAINER Luke Vlcek <vlcek@webvalley.cz>

ADD docker/php.ini /usr/local/etc/php/
ADD docker/000-default.conf /etc/apache2/sites-available/000-default.conf
ADD . /var/app

WORKDIR /var/app

EXPOSE 80

RUN apt-get update && apt-get -y install \
        git \
        libcurl4-openssl-dev \
        libpq-dev \
        libmcrypt-dev \
        libpq5 \
        zlib1g-dev \
        libxml2-dev \

    && docker-php-ext-install soap \
    && docker-php-ext-install curl json mbstring opcache pdo_mysql zip \
    && yes '' | pecl install -o -f apcu-4.0.10 \
    && rm -rf /tmp/pear \
    && echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \

    && rm -rf /var/app/app/config/parameters.yml \
    && mkdir -p /var/app/app/cache \
    && mkdir -p /var/app/app/logs \
    && chmod 0777 -R /var/app/app/cache \
    && chmod 0777 -R /var/app/app/logs \

    && a2ensite 000-default.conf \
    && a2enmod expires \
    && a2enmod rewrite \
    && service apache2 restart \

  RUN chmod +x entrypoint.sh

ENTRYPOINT ["sh", "entrypoint.sh"]