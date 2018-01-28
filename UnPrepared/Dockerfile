FROM php:fpm-stretch

RUN mkdir -p /usr/share/man/man1
RUN apt-get update && apt-get install -y openjdk-8-jdk-headless openjdk-8-jre-headless

COPY ./db/ /db/


RUN echo "#!/bin/sh\n#cp -R /db/unprepared.db /tempdb/\necho 'done'\ncat /usr/local/bin/docker-php-entrypoint\n$(cat /usr/local/bin/docker-php-entrypoint)" > /usr/local/bin/docker-php-entrypoint

