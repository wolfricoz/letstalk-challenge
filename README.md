# Let's Talk Coding Challenge

## Overview
I have to create a website with an authentication system that allows users to sign up, log in, and log out. The users who can log in should be in the IP address table. The website should allow users to convert currency from one to another.

The goal is to do this in less than 8 hours, and with the bonus objectives my goal is 16 hours.


## Requirements to install
* [PHP 8.2](https://www.php.net/manual/en/install.php) (for laravel 11)
* Composer (included as composer.phar in the project.)
* [docker](https://docs.docker.com/engine/install/)
* [ddev](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/) (optional, but recommended.)
* [Node.js v22.2.0](https://nodejs.org/en/download/package-manager/current)
* npm / [yarn](https://classic.yarnpkg.com/lang/en/docs/install/) (choose your preferred package manager, compatitable with npm)

## Installation
You can go to the installation pages for the requirements by clicking on the names above, with the exception of composer which is included in the project. These pages have much better instructions than I could provide here.

To install the project, you need to run the following commands:
```bash
composer install
cp .env.example .env
php artisan key:generate
```
Once you've done that you can either edit the .env to include the required information or if you plan to use ddev you can leave it blank for now.

## (optional) Installing DDEV
The docker files were generated with ddev and I highly recommend using it for the best experience. To install ddev you can follow the instructions on their website: https://ddev.readthedocs.io/en/latest/users/install/ddev-installation/

Once you have ddev installed you can run the following command to start the project:
```bash
ddev config # This will setup your docker files
ddev start # This starts the docker containers
```

If you are using windows, I highly recommend changing the following setting to improve performance as I've experienced slow and sluggish performance without it:
```bash
ddev config --performance-mode=mutagen
```
More information can be found here: https://ddev.readthedocs.io/en/stable/users/install/performance/#mutagen

If you run into certificate issues, you may have to register the certificates with your system. 

To create the certificates you can run the following command:
```bash
mkcert -install
mkcert -CAROOT
```

For example in firefox you can go to `about:preferences#privacy` and scroll down to `Certificates` and click on `View Certificates` and then import the certificates. fetch the files from the directory that mkcert -CAROOT gives you and import them into your browser
This article goes into more detail: https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/#windows

## whitelisting IP addresses
To whitelist IP addresses you can run the following command:
```bash
php artisan ip:allow (ip)
```
This will add the IP address to the whitelist table and allow the user to access the website.

## updating the exchange rates
To update the exchange rates you can run the following command:
```bash
php artisan currency:update
```
