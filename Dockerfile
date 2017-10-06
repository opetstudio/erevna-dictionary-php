#FROM php:7-fpm
#FROM nginx
FROM nimmis/apache-php5

MAINTAINER Opetstudio <opetstudio@gmail.com>


#sudo apt-get install -y nginx
#sudo apt-get install -y php7.0 php7.0-fpm php7.0-cli php7.0-common php7.0-mbstring php7.0-gd php7.0-intl php7.0-xml php7.0-mysql php7.0-mcrypt php7.0-zip

#RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client && docker-php-ext-install mcrypt pdo_mysql
#ADD ./site.conf /etc/nginx/conf.d/default.conf

# Install app dependencies
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
# Change Nginx config here...
#RUN rm /etc/nginx/conf.d/default.conf
#ADD ./site.conf /etc/nginx/conf.d/default.conf

# Create app directory
#WORKDIR /var/www
# Create app directory
WORKDIR /var/www/src


# Bundle app source
# RUN rm -rf *
COPY ./src .

COPY composer.json ../

RUN cd .. && curl -sS https://getcomposer.org/installer | php && php composer.phar install

#RUN php composer.phar install

EXPOSE 80
EXPOSE 443
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
#CMD ["ps", "-ef", "|grep" -i nginx]
