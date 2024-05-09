FROM php:8.1.28-apache-bullseye

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/html/

# Install dependency
RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s mysqli
RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/html

# Change current user to www
USER www

# Prepare runtime
RUN php artisan key:generate
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
