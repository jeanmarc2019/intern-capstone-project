FROM phpdockerio/php71-fpm:latest
# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install zip unzip php7.1-mysql php7.1-intl php7.1-mbstring php7.1-sqlite3\
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
#RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
#RUN php composer-setup.php --install-dir=../../../bin --filename=composer
#RUN php -r "if (true) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
#RUN apt-get update && \
#        apt-get install -y --no-install-recommends git zip
#
#RUN curl --silent --show-error https://getcomposer.org/installer | php
#COPY ./composer.json .
#COPY ./docker-php-ext-zip.ini ../../../usr/local/etc/php/conf.d/
#RUN yum install -y zip unzip php7.0-zip && apt install -y zip unzip php7.0-zip
#RUN composer global require laravel/installer
#RUN composer install
#RUN curl -L https://github.com/laravel/laravel/archive/v5.8.1.tar.gz | tar xz
#RUN mv laravel-5.8.1 my-site

#docker container exec -it my-running-app bash
