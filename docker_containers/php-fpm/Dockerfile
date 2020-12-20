FROM phpdockerio/php74-fpm:latest
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.4-pgsql php7.4-bcmath php7.4-gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*


# Install Symfony CLI
ARG INSTALL_SYMFONY=false

RUN if [ ${INSTALL_SYMFONY} = true ]; then \
  apt-get update && apt-get install --no-install-recommends -y wget \
  && wget https://get.symfony.com/cli/installer -O - | bash \
  && mv /root/.symfony/bin/symfony /usr/local/bin/symfony \
;fi


# Install Xdebug
ARG INSTALL_XDEBUG=false

COPY ./xdebug.ini /etc/php/7.4/fpm/conf.d/20-xdebug.ini

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
 apt-get update \
    && apt-get -y --no-install-recommends install  php7.4-xdebug \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && sed -i 's/^;//g' /etc/php/7.4/fpm/conf.d/20-xdebug.ini \
;fi
