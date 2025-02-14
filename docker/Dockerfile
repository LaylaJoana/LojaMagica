# Use a imagem oficial do PHP com Apache
FROM php:8.3-apache

# Instale as extensões necessárias do PHP
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilitar o módulo mod_rewrite do Apache
RUN a2enmod rewrite

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina o diretório de trabalho
WORKDIR /var/www/html/

# Copie o arquivo composer.json e composer.lock
COPY composer.json composer.lock ./

# Instale as dependências do Composer
RUN composer install

# Copie o conteúdo do projeto para o diretório padrão do Apache
COPY . /var/www/html/

# Ajuste as permissões
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Copie o php.ini personalizado
COPY docker/php.ini /usr/local/etc/php/

# Exponha a porta 80
EXPOSE 80