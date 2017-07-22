# laravel.app

## Table of Contents
* [Installation](#installation)

## Installation
To run this you must first have composer, php, nodejs/npm, virtualbox and vagrant.

Download or clone the repo, once done navigate to the main directory in the command line and run the following commands.
```bash
cp .env.example .env
composer install
```

Next you'll need an environment file so copy .env.example to .env using your preferred method.

This will install all your dependencies and get your assets up to date

Once you've done that you'll want to get a [Laravel Homstead](https://laravel.com/docs/5.4/homestead#per-project-installation) box up and running

To do so run the following command

Mac/Linux:
```bash
php vendor/bin/homestead make
```

Windows:
```bash
vendor\\bin\\homestead make
```

Once you've done that you can check the Homestead.yaml file it created to make sure it looks correct.
You may need to do things like adjust your network settings to get your virtualmachine online.
```yaml
networks:
    - type: "public_network"
      bridge: "eth0"
```
Run the following command to bring your new homestead virtual machine up:
```bash
vagrant up
```

While that is running modify your hosts file adding the proper ipaddress and hostename from your 
Homestead.yaml file (192.168.10.10 laravel.app).

```bash
php artisan migrate:refresh --seed
```

Once homestead has booted you should be able to access it locally by navigating to laravel.app.