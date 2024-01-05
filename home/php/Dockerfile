FROM php:8.0-apache

RUN docker-php-ext-install mysqli

RUN apt update && apt install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libwebp-dev \
        libpng-dev
RUN docker-php-ext-configure gd --with-freetype --with-webp --with-jpeg && \
    docker-php-ext-install gd

RUN a2enmod rewrite
RUN a2enmod vhost_alias

RUN echo "UseCanonicalName Off\nVirtualDocumentRoot \"/var/www/html/%-2.0.%-1.0/%-3\"\nphp_admin_value auto_prepend_file /var/www/html/setdocroot.php" >> /etc/apache2/apache2.conf
