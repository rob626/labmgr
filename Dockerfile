FROM php:apache
RUN a2enmod rewrite && docker-php-ext-install mysqli && ln -fs /usr/share/zoneinfo/America/New_York /etc/localtime && dpkg-reconfigure -f noninteractive tzdata && apachectl -k restart
COPY . /var/www/html