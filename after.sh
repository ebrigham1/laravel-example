#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.

cd /home/vagrant/code
# Set up the code style checking pre-commit hook
cp codesniffer/pre-commit .git/hooks/pre-commit
cp codesniffer/config-pre-commit .git/hooks/config-pre-commit
# Make sure composer is completely up to date
sudo composer self-update
sudo apt update
yes | sudo apt install php7.2-ldap
yes | sudo apt install htop
yes | sudo apt autoremove
composer install
# Generate the application security key
php artisan key:generate
# Reset the database and seeds
php artisan migrate:refresh --seed
# Install the socket.io server globally for laravel echo
sudo npm install -g --unsafe-perm laravel-echo-server
# Make sure all npm packages are installed
npm install
# Run the front end assets
npm run dev
# Set up supervisor for the echo server and horizon queue manager
sudo cp supervisor/horizon.conf /etc/supervisor/conf.d/horizon.conf
sudo cp supervisor/echo-server.conf /etc/supervisor/conf.d/echo-server.conf
sudo cp supervisor/npm-watch.conf /etc/supervisor/conf.d/npm-watch.conf
sudo supervisorctl reread
sudo supervisorctl update
cd
