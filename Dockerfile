FROM php:8.4-apache

RUN sed -i 's|http://deb.debian.org|https://deb.debian.org|g' \
    /etc/apt/sources.list.d/debian.sources
    #取得する先のURLをhttp→httpsに変更

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    libzip-dev
    # 必要な道具をインストールする
    # zip/unzip → 圧縮ファイルを扱う、git → バージョン管理、libzip-dev → zip機能の土台

RUN docker-php-ext-install pdo_mysql zip
    # pdo_mysql が無いとLaravelからDBに接続できない

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN a2enmod rewrite

RUN sed -i 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/000-default.conf
