#filename: Vagrant.provision.sh
#!/usr/bin/env bash

# ---------------------------------------------------------------------------------------------------------------------
# Variables & Functions
# ---------------------------------------------------------------------------------------------------------------------
APP_DATABASE_NAME='esi'

echoTitle () {
    echo -e "\033[0;30m\033[42m -- $1 -- \033[0m"
}


# ---------------------------------------------------------------------------------------------------------------------
echoTitle 'Virtual Machine Setup'
# ---------------------------------------------------------------------------------------------------------------------
# Update packages
apt-get update -qq
apt-get -y install git curl vim


# ---------------------------------------------------------------------------------------------------------------------
# echoTitle 'MYSQL-Database'
# ---------------------------------------------------------------------------------------------------------------------
# Setting MySQL (username: root) ~ (password: password)
sudo debconf-set-selections <<< 'mysql-server-5.6 mysql-server/root_password password password'
sudo debconf-set-selections <<< 'mysql-server-5.6 mysql-server/root_password_again password password'


# Installing packages
apt-get install -y mysql-server-5.6 mysql-client-5.6 mysql-common-5.6


# Setup database
mysql -uroot -ppassword -e "CREATE DATABASE IF NOT EXISTS $APP_DATABASE_NAME;";
mysql -uroot -ppassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'password';"
mysql -uroot -ppassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY 'password';"
sudo service mysql restart


# Import SQL file
# mysql -uroot -ppassword database < my_database.sql


# ---------------------------------------------------------------------------------------------------------------------
echoTitle 'Installing: PHP'
# ---------------------------------------------------------------------------------------------------------------------
# Add repository
add-apt-repository ppa:ondrej/php
apt-get update
apt-get install -y python-software-properties software-properties-common


# Install packages
apt-get install -y php7.1 php7.1-fpm
apt-get install -y php7.1-mysql
apt-get install -y mcrypt php7.1-mcrypt
apt-get install -y php7.1-cli php7.1-curl php7.1-mbstring php7.1-xml php7.1-mysql
apt-get install -y php7.1-json php7.1-cgi php7.1-gd php-imagick php7.1-bz2 php7.1-zip


# ---------------------------------------------------------------------------------------------------------------------
# Git & Composer
# ---------------------------------------------------------------------------------------------------------------------
echoTitle 'Installing: Git'
apt-get install -y git

echoTitle 'Installing: Composer'
curl -s https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer


# ---------------------------------------------------------------------------------------------------------------------
# YII2
# ---------------------------------------------------------------------------------------------------------------------
#echoTitle 'Installing: Yii2'
#cd /var/www/html/motoflame
#composer create-project --prefer-dist yiisoft/yii2-app-basic basic
#git init
#git remote add origin https://github.com/andrewverner/motoflame.git


# ---------------------------------------------------------------------------------------------------------------------
# XDebug
# ---------------------------------------------------------------------------------------------------------------------
echoTitle 'Installing: XDebug'
apt-get install php7.1-xdebug
cat >> /etc/php/7.1/mods-available/xdebug.ini <<'EOF'
xdebug.remote_enable=1
xdebug.remote_port=9000
xdebug.remote_host=localhost
xdebug.idekey=PHPSTORM
EOF


# ---------------------------------------------------------------------------------------------------------------------
# NGINX
# ---------------------------------------------------------------------------------------------------------------------
echoTitle 'Installing: NGINX'
apt-get install -y nginx
rm /etc/nginx/sites-available/default
touch /etc/nginx/sites-available/default

mkdir /var/www/log
touch /var/www/log/esi_access.log
touch /var/www/log/esi_error.log

cat >> /etc/nginx/sites-enabled/motoflame.conf <<'EOF'
server {
  listen   80;
  root /var/www/html/esi;
  index index.php index.html;
  server_name esi.local;
  error_log /var/www/log/esi_error.log;
  access_log /var/www/log/esi_access.log;
  location / {
    try_files $uri $uri/ /index.php$is_args$args;
  }
  location ~ ^/assets/.*\.php$ {
        deny all;
    }
  location ~ \.php$ {
    try_files $uri /index.php =404;
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_pass unix:/run/php/php7.1-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
  }
}
EOF

echoTitle 'Starting NGINx'
sudo service nginx start

# ---------------------------------------------------------------------------------------------------------------------
# Others
# ---------------------------------------------------------------------------------------------------------------------
# Output success message
echoTitle "Your machine has been provisioned"
echo "-------------------------------------------"
echo "MySQL is available on port 3306 with username 'root' and password 'password'"
echo "(you have to use 127.0.0.1 as opposed to 'localhost')"
echo "NGINX is available on port 80"
echo "Don't forget to:"
echo "1. generate ssh-key and contact to admin to be able to pull project changes from the repo"
echo "2. add the following line into hosts file:"
echo "192.168.100.105   esi.local"
echo -e "Head over to http://esi.local/ or http://192.168.100.105/ to get started"
