#filename: Vagrant.provision.sh
#!/usr/bin/env bash

# ---------------------------------------------------------------------------------------------------------------------
# Variables & Functions
# ---------------------------------------------------------------------------------------------------------------------
MOTOFLAME_DATABASE_NAME='motoflame'
EVE_DATABASE_NAME='eveservice'
FETISH_DATABASE_NAME='fetish'
RUBBER_DATABASE_NAME='rubber'

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
mysql -uroot -ppassword -e "CREATE DATABASE IF NOT EXISTS $MOTOFLAME_DATABASE_NAME;";
mysql -uroot -ppassword -e "CREATE DATABASE IF NOT EXISTS $EVE_DATABASE_NAME;";
mysql -uroot -ppassword -e "CREATE DATABASE IF NOT EXISTS $FETISH_DATABASE_NAME;";
mysql -uroot -ppassword -e "CREATE DATABASE IF NOT EXISTS $RUBBER_DATABASE_NAME;";
mysql -uroot -ppassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'password';"
mysql -uroot -ppassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' IDENTIFIED BY 'password';"
sudo service mysql restart

mysql -u root -ppassword motoflame < /provision/dumps/motoflame.sql
mysql -u root -ppassword eveservice < /provision/dumps/eveservice.sql


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
apt-get install -y php7.1-json php7.1-cgi php7.1-gd php-imagick php7.1-bz2 php7.1-zip php7.1-bcmath


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
echoTitle 'Installing: Yii2 Motoflame'
cd /var/www/html
sudo mkdir motoflame
cd motoflame
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
git init
git remote add origin https://andrewverner:sin45sqrt22@github.com/andrewverner/motoflame.git
git fetch origin
git reset --hard origin/master
cd basic
./yii migrate --interactive=0
rm composer.lock
composer install


echoTitle 'Installing: Yii2 EVE Service'
cd /var/www/html
composer create-project --prefer-dist yiisoft/yii2-app-basic eve-service
cd eve-service
git init
git remote add origin https://andrewverner:sin45sqrt22@github.com/andrewverner/eve-service.git
git fetch origin
git reset --hard origin/master
cp /provision/db/eveservice/* /var/www/html/eve-service/config/
./yii migrate --interactive=0
rm composer.lock
composer install

echoTitle 'Installing: Fetish landing'
cd /var/www/html
composer create-project --prefer-dist yiisoft/yii2-app-basic fetish
cd fetish
git init
git remote add origin https://andrewverner:sin45sqrt22@github.com/andrewverner/fetish.git
git fetch origin
git reset --hard origin/master
cp /provision/db/fetish/* /var/www/html/fetish/config/
./yii migrate --interactive=0
composer install

echoTitle 'Installing: Rubber community'
cd /var/www/html
composer create-project --prefer-dist yiisoft/yii2-app-basic rubber
cd rubber
git init
git remote add origin https://andrewverner:sin45sqrt22@github.com/andrewverner/rubber.git
git fetch origin
git reset --hard origin/master
cp /provision/db/rubber/* /var/www/html/rubber/config/
./yii migrate --interactive=0
composer install

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

mkdir /var/www/log
touch /var/www/log/motoflame_access.log
touch /var/www/log/motoflame_error.log
touch /var/www/log/eve_access.log
touch /var/www/log/eve_error.log
touch /var/www/log/fetish_access.log
touch /var/www/log/fetish_error.log
touch /var/www/log/rubber_error.log
touch /var/www/log/rubber_error.log
sudo cp /provision/nginx/sites-enabled/* /etc/nginx/sites-enabled/


echoTitle 'Installing Redis'
sudo apt-get update
sudo apt-get install build-essential tcl
cd /tmp
curl -O http://download.redis.io/redis-stable.tar.gz
tar xzvf redis-stable.tar.gz
cd redis-stable
make
make test
sudo make install
sudo mkdir /etc/redis
sudo cp /provision/redis/redis.conf /etc/redis/
sudo cp /provision/redis/redis.service /etc/systemd/system/
sudo adduser --system --group --no-create-home redis
sudo mkdir /var/lib/redis
sudo chown redis:redis /var/lib/redis
sudo chmod 770 /var/lib/redis


echoTitle 'Installing RabbitMQ'
sudo apt-get install -y rabbitmq-server
sudo service rabbitmq-server start


echoTitle 'Starting NGINx'
sudo service nginx restart

echoTitle 'Starting Redis'
redis-server &

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
echo "192.168.100.105   eve.local"
echo "192.168.100.105   motoflame.local"
echo "192.168.100.105   fetish.local"
echo "192.168.100.105   rubber.local"
echo -e "Head over to http://eve.local/, http://motoflame.local/ or http://192.168.100.105/ to get started"
