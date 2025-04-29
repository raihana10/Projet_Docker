FROM php:8.3-fpm

ARG user
ARG uid
#dependencies
#update systeme package list and install dependencies
RUN apt-get update && apt-get install -y \ 
    #utiliser git zip ... dans contenaire
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip 
    #clear cache (package installed and non needed) optionnelle
RUN apt-get clean && rm -rf /var/lib/apt/lists/* 

 #install php extensions
 #pdo pour mysql database socket pour se connecter
 #mbstring manipulating strings
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

 #composer
 #copier composer from dockerhub to docker container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#ajouter user a user group
RUN useradd -u $uid -ms /bin/bash -g www-data $user

COPY . /var/www
COPY --chown=$user:www-data . /var/www

WORKDIR /var/www

RUN composer install --no-dev --optimize-autoloader


USER $user

EXPOSE 9000

CMD ["php-fpm"]