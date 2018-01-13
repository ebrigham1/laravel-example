#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.

cd /home/vagrant/code
cp pre-commit .git/hooks/pre-commit
cp config-pre-commit .git/hooks/config-pre-commit
#sudo npm install -g laravel-echo-server
#laravel-echo-server init
npm install
npm run dev
php artisan key:generate
php artisan migrate:refresh --seed
cd
