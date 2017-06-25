#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.
cp pre-commit .git/hooks/pre-commit
cp config-pre-commit .git/hooks/config-pre-commit
