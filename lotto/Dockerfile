FROM php:fpm-stretch

RUN apt-get update

RUN mkdir -p /usr/share/man/man1
RUN apt-get install -y openjdk-8-jdk-headless openjdk-8-jre-headless

ADD ./javacode /javacode
RUN javac /javacode/GenerateLottoNumbers.java