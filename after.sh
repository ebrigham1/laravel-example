#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.

cp /home/vagrant/Code/laravel-clone/pre-commit /home/vagrant/Code/laravel-clone/.git/hooks/pre-commit
cp /home/vagrant/Code/laravel-clone/config-pre-commit /home/vagrant/Code/laravel-clone/.git/hooks/config-pre-commit
