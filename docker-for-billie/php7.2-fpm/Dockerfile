FROM phpdockerio/php72-fpm

RUN apt-get upgrade

RUN apt-get update && apt-get install -y \
# utilities
git unzip vim wget bash-completion iputils-ping build-essential git-flow ssh \
# required dependencies
python-dev python-setuptools python-pip libconfig-inifiles-perl libyaml-dev \
php7.2-bcmath php7.2-bz2 php7.2-cli php7.2-common php7.2-curl php7.2-cgi \
php7.2-dev php7.2-fpm php7.2-gd php7.2-gmp php7.2-imap php7.2-intl \
php7.2-json php7.2-ldap php7.2-mbstring php7.2-mysql php7.2-odbc \
php7.2-opcache php7.2-pgsql php7.2-phpdbg php7.2-pspell php7.2-readline \
php7.2-recode php7.2-soap php7.2-sqlite3 php7.2-tidy php7.2-xml php7.2-xmlrpc \
php7.2-xsl php7.2-zip php7.2-xdebug php7.2-exif 


# Fix user uid and gid 1000 not being in use
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
RUN sed -i 's/short_open_tag = Off/short_open_tag = On/' /etc/php/7.2/fpm/php.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version \
    && composer global require "fxp/composer-asset-plugin" "balping/artisan-bash-completion"

RUN curl -sL https://deb.nodesource.com/setup_8.x | bash - \
&& apt-get install -y nodejs

# we can add more stuff here when and if we need it
RUN npm install -g bower less yarn gulp-cli swagger-cli

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Berlin /etc/localtime
RUN "date"

COPY ./.bashrc /root/.bashrc
COPY ./.gitconfig /root/.gitconfig

COPY ./xdebug/30-xdebug.ini-fpm /etc/php/7.2/fpm/conf.d/30-xdebug.ini
COPY ./xdebug/30-xdebug.ini-cli /etc/php/7.2/cli/conf.d/30-xdebug.ini

COPY ./php/php.ini-fpm /etc/php/7.2/fpm/php.ini
COPY ./php/php.ini-cli /etc/php/7.2/cli/php.ini

RUN touch /var/log/php-xdebug.log

RUN touch /root/.bash_history

WORKDIR /var/www/billie

