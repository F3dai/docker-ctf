#+++++++++++++++++++++++++++++++++++++++
# Dockerfile for webdevops/php-nginx:7.1
#    -- automatically generated  --
#+++++++++++++++++++++++++++++++++++++++

# Using php7.1 for assert vulnerability
FROM webdevops/php:7.1

ENV WEB_DOCUMENT_ROOT=/app \
    WEB_DOCUMENT_INDEX=index.php \
    WEB_ALIAS_DOMAIN=*.vm \
    WEB_PHP_TIMEOUT=600 \
    WEB_PHP_SOCKET=""
ENV WEB_PHP_SOCKET=127.0.0.1:9000
ENV SERVICE_NGINX_CLIENT_MAX_BODY_SIZE="50m"

# Copy web app and config over
COPY conf/ /opt/docker/
COPY data /app/

RUN set -x \
    # Install nginx
    && apt-install \
        nginx curl nano net-tools sudo \
    && docker-run-bootstrap \
    && docker-image-cleanup

RUN echo "display_errors = On" >> /opt/docker/etc/php/php.ini

# Open up web ports
EXPOSE 80 443

# SUID exploitation
RUN  chmod u+s /usr/bin/python
