FROM php:8.2-apache

# ติดตั้ง Extension สำหรับต่อ MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/
RUN a2enmod rewrite
EXPOSE 80