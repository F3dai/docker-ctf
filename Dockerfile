#++++++++++++++++++++++++++++++++++++++++#
#    Dockerfile for f3dai web app CTF    #
#++++++++++++++++++++++++++++++++++++++++#

# Using php7.1 for assert vulnerability
FROM webdevops/php:7.1

# Set env stuffs
ENV WEB_DOCUMENT_ROOT=/app \
    WEB_DOCUMENT_INDEX=index.php \
    WEB_ALIAS_DOMAIN=*.vm \
    WEB_PHP_TIMEOUT=600 \
    WEB_PHP_SOCKET=""
ENV WEB_PHP_SOCKET=127.0.0.1:9000
ENV SERVICE_NGINX_CLIENT_MAX_BODY_SIZE="50m"
# Allow application to run php-fpm (root user)
ENV SERVICE_PHPFPM_OPTS="-R"

# Copy web web app and configs over
COPY conf/ /opt/docker/
COPY data /app/

# Installations
RUN set -x \
    && apt-install \
        nginx curl nano net-tools socat sudo iproute2 openssh-server \
    && docker-run-bootstrap \
    && docker-image-cleanup

# Run nginx as root
# RUN sed -i 's/www-data/root/' /etc/nginx/nginx.conf
# RUN sed -i 's/www-data/root/' /usr/local/etc/php-fpm.d/www.conf.default

# Add user
RUN useradd -ms /bin/bash terry
RUN echo 'terry:ESTRELLA' | chpasswd
RUN echo 'root:Hack.Th3.T3mp13' | chpasswd
RUN echo 'application:T3mp13.0s' | chpasswd

# Open up web and ssh ports
EXPOSE 80 22

# Permissions
COPY user.txt /home/terry
RUN chown -R terry:terry /home/terry
RUN chmod -R 711 /app
RUN chmod -R 755 /app/media
RUN usermod -ou 0 -g 0 application
