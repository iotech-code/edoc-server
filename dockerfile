FROM php:7.1-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    supervisor \
    pkg-config \
    libonig-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    libldap2-dev \
    nginx \
    nginx-extras
# Clear cache
RUN apt-get -y --no-install-recommends install g++ zlib1g-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*


# Install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip
RUN docker-php-ext-install gd 
RUN docker-php-ext-install ldap
RUN docker-php-ext-enable ldap

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www/html/
COPY ./php/local.ini /usr/local/etc/php/conf.d/local.ini
# Copy nginx config
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./start.sh /
COPY ./supervisord.conf /
RUN composer install

# set time zone service to bangkok
ENV TZ=Asia/Bangkok  
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
# Copy existing application directory contents
# Change current user to www
RUN chown -R www-data:www-data /var/www/html
RUN chmod 777 -R /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependency
# RUN /usr/local/bin/composer install
# Add nginx user
RUN useradd -r nginx

USER root

EXPOSE 80 443

ENTRYPOINT [ "/start.sh" ]