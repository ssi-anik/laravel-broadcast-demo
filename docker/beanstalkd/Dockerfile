FROM debian:stable

MAINTAINER Syed Sirajul Islam Anik "sirajul.islam.anik@gmail.com"

RUN apt-get update && apt-get install -y beanstalkd

RUN mkdir -p /binlog

VOLUME [ "/binlog" ]

RUN service beanstalkd start

EXPOSE 11300

CMD ["beanstalkd", "-p", "11300", "-b", "/binlog"]
