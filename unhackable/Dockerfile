FROM nginx:latest

RUN rm -rf /usr/share/nginx/html/*
COPY ./code.tar.gz /usr/share/nginx/html/
RUN tar -xzvf /usr/share/nginx/html/code.tar.gz --directory /usr/share/nginx/html/
RUN mv /usr/share/nginx/html/gitrepo/.git/ /usr/share/nginx/html/
RUN mv /usr/share/nginx/html/gitrepo/* /usr/share/nginx/html/
RUN rm -rf /usr/share/nginx/html/gitrepo/
RUN rm -rf /usr/share/nginx/html/code.tar.gz
RUN chmod -R o+rx /usr/share/nginx/html/

USER root
COPY ./site.conf /etc/nginx/conf.d/default.conf
