#!/usr/bin/env bash

#== Import script args ==

timezone=$(echo "$1")

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

info "Allocate swap for MySQL 5.6"
fallocate -l 2048M /swapfile
chmod 600 /swapfile
mkswap /swapfile
swapon /swapfile
echo '/swapfile none swap defaults 0 0' >> /etc/fstab

info "Configure locales"
update-locale LC_ALL="C"
dpkg-reconfigure locales

info "Configure timezone"
echo ${timezone} | tee /etc/timezone
dpkg-reconfigure --frontend noninteractive tzdata

info "Prepare root password for MySQL"
debconf-set-selections <<< "mysql-server-5.6 mysql-server/root_password password \"''\""
debconf-set-selections <<< "mysql-server-5.6 mysql-server/root_password_again password \"''\""
echo "Done!"

info "Update OS software"
apt-get update
apt-get upgrade -y

info "Install additional software"
apt-get install -y git php libapache2-mod-php php-mcrypt php-mysql mysql-server-5.6 apache2
php5enmod mcrypt apache2 unzip
a2enmod rewrite

info "Configure MySQL"
sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf
echo "Done!"

#info "Configure NGINX"
#sed -i 's/user www-data/user vagrant/g' /etc/nginx/nginx.conf
#echo "Done!"

info "Enabling site configuration"
ln -s /data/vagrant/vagrant/apache/vhost-vagrant.conf /etc/apache2/sites-enabled/motherearth.conf
echo "Done!"

#info "Initailize databases for MySQL"
mysql -uroot <<< "CREATE DATABASE motherearth"
mysql -uroot <<< "CREATE USER 'motherearth'@'localhost' IDENTIFIED BY 'm0ther3arth'"
mysql -uroot <<< "GRANT ALL PRIVILEGES ON motherearth . * TO 'motherearth'@'localhost'"
mysql -uroot <<< "FLUSH PRIVILEGES"
#unzip /opt/vagrant/db/dump_pfw_20171024.sql.zip | mysql -u pfwuser -pVhZbVQcBVmVQaQo6UGc= pfw
echo "Done!"

info "Install composer"
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer