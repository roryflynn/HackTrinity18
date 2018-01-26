FROM python:2.7-alpine
RUN apk update && \
    apk add python python-dev libffi-dev gcc make musl-dev py-pip mysql-client libxml2-dev libxslt-dev

#RUN apk update && \
#    apk add python python-dev libffi-dev gcc make musl-dev py-pip postgresql-client postgresql-dev

RUN mkdir -p /opt/CTFd
COPY . /opt/CTFd
WORKDIR /opt/CTFd
VOLUME ["/opt/CTFd"]

RUN pip install -r requirements.txt

#install plugin dependencies too
RUN pip install -r CTFd/plugins/ctfd-recaptcha-plugin/requirements.txt

RUN chmod +x /opt/CTFd/docker-entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/opt/CTFd/docker-entrypoint.sh"]
