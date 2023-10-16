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
        && apt-get update && \
        apt-get install -y nginx php${PHPVER} php${PHPVER}-fpm php${PHPVER}-mysql php${PHPVER}-zip php${PHPVER}-gd  php${PHPVER}-mbstring   php${PHPVER}-curl php${PHPVER}-xml php${PHPVER}-bcmath php${PHPVER}-json curl build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev libicu-dev unzip

RUN rm -v /etc/nginx/nginx.conf
ADD ./nginx.conf /etc/nginx/
RUN ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/htdocs
COPY project /var/www/html/project
RUN composer install
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
