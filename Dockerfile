FROM php:8.2-apache

# ติดตั้งส่วนเสริมที่จำเป็น
RUN apt-get update && apt-get install -y libpng-dev libzip-dev zip unzip git
RUN docker-php-ext-install pdo_mysql gd zip

# ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ตั้งค่า Apache
RUN a2enmod rewrite
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# คัดลอกไฟล์ทั้งหมด
COPY . /var/www/html
WORKDIR /var/www/html

# <--- เพิ่มส่วนนี้เข้าไปเพื่อให้มันติดตั้ง library ให้ครบ --->
RUN composer install --no-dev --optimize-autoloader

# ตั้งค่า permission
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache