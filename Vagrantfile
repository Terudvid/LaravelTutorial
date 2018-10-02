Vagrant.configure("2") do |config|
  config.vm.box = "bento/centos-7.2"
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "private_network", ip: "192.168.50.30"

  config.vm.provision "shell", inline: <<-SHELL
  yum -y update
  yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
  yum -y install httpd git yum
  yum -y --enablerepo=remi,remi-php71 install php php-cli php-common php-devel php-fpm php-gd php-mbstring php-mysqlnd php-pdo php-pear php-pecl-apcu php-soap php-xml php-xmlrpc php-pecl-zip php-zip php-intl

  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  php -r "if (hash_file('SHA384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
  php composer-setup.php
  php -r "unlink('composer-setup.php');"
  mv composer.phar /usr/local/bin/composer

  yum -y remove mysql*
  yum -y install http://dev.mysql.com/get/mysql-community-release-el6-5.noarch.rpm
  yum -y install mysql mysql-devel mysql-server
  #yum install mysql mysql-devel mysql-server mysql-utilities

 SHELL

config.vm.provision "shell", run: "always", inline: <<-SHELL
 systemctl restart httpd.service
SHELL

end
