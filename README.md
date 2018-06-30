# laravel.test

## Table of Contents
* [Installation](#installation)

## Installation
To run this you must first have composer, php, virtualbox and vagrant.

Tested on VirtualBox 5.2.6 and Vagrant 2.1.1

Download or clone the repo, once done navigate to the main directory in the command line and run the following commands.
```bash
cp .env.example .env
composer install --ignore-platform-reqs
```

Run the following command to bring your new homestead virtual machine up:
```bash
vagrant up
```

While that is running modify your hosts file adding the proper ipaddress and hostename from your 
Homestead.yaml file (192.168.10.10 laravel.test).

Once homestead has booted you should be able to access it locally by navigating to laravel.test.