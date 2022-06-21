FROM php:7.3-apache
LABEL maintainer="Jaivic"

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    zlib1g-dev \ 
    libicu-dev \ 
    libxml2-dev \ 
    libpq-dev \ 
    vim

RUN docker-php-ext-install pdo_mysql
#RUN docker-php-ext-install pdo pdo_mysql zip intl xmlrcp soap opcache 
# RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd

RUN apt-get install nano -y

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs
RUN apt-get autoremove -y
#RUN apt install -y npm

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY docker/php/php.ini /usr/local/etc/php/
COPY docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
#COPY docker/apache/apache2.conf /etc/apache2/apache2.conf  

#suppress the do-not-run-as-root warning from composer
ENV COMPOSER_ALLOW_SUPERUSER 1

COPY . /var/www/html/
COPY docker/.env.dev /var/www/html/.env
WORKDIR /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && composer install