FROM ubuntu:20.04
LABEL maintainer="tayla.ward1@uqconnect.edu.au"

ENV PHPVER=8.2
ENV timezone=Australia
ENV city=Brisbane


RUN apt-get update \
# Set Timezone
        && apt-get update \
        && ln -fs /usr/share/zoneinfo/${timezone}/${city} /etc/localtime \
        && DEBIAN_FRONTEND=noninteractive apt-get install -y tzdata \
        && dpkg-reconfigure --frontend noninteractive tzdata \
# Install dependancies
        && apt-get install --no-install-recommends \
                --no-install-suggests -qq \
                -y wget gnupg2 ca-certificates \
        && apt-get install software-properties-common -y --no-install-recommends \
#Install Nginx, PHP, PHP-FPM
        && add-apt-repository ppa:ondrej/php -y \
        && apt-get update \
        && apt-get install -y --no-install-recommends nginx php${PHPVER}-fpm

COPY ./nginx.ini /etc/nginx/sites-available/default

WORKDIR /var/www/htdocs
                                                            
COPY ./project ./

EXPOSE 80


ENTRYPOINT service php${PHPVER}-fpm start && nginx -g "daemon off;"