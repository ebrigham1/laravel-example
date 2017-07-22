#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.

(cd ~/laravel && exec cp pre-commit .git/hooks/pre-commit)
(cd ~/laravel && exec cp config-pre-commit .git/hooks/config-pre-commit)
(cd ~/laravel && exec npm install)
(cd ~/laravel && exec npm run dev)
(cd ~/laravel && exec php artisan key:generate)
(cd ~/laravel && exec php artisan migrate:refresh --seed)
