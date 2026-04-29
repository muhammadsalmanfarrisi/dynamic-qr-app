FROM php:8.2-fpm

# Instal ekstensi sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Instal ekstensi PHP (termasuk PostgreSQL untuk Neon)
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Ambil Composer terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Salin file proyek
COPY . .

# Instal dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Berikan izin akses folder storage & cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Jalankan server
CMD php artisan serve --host=0.0.0.0 --port=$PORT