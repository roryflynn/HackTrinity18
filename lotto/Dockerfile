FROM php:fpm

RUN apt-get update
RUN apt-get install -y default-jre default-jdk

ADD ./javacode /javacode
RUN javac /javacode/GenerateLottoNumbers.java