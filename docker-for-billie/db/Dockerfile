FROM mysql:5.6.37

RUN apt-get upgrade

RUN apt-get update && apt-get install -y git unzip vim wget git bash-completion iputils-ping  build-essential tcl

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Berlin /etc/localtime
RUN "date"

RUN "date"

COPY ./.bashrc /root/.bashrc
RUN touch /root/.bash_history

WORKDIR /var/www/
