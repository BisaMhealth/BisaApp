# Bisa Health App - Web Frontend

> ### This is the complete Web Frontend for the Bisa Mobile App

The functionality of this rep is complete - Issues encountered can be shared with us.
----------

- [About](#about-bisa-app)
- [Requirements](#requirements)
- [Easy Installation](#easy-installation)
- [Server Setup](#server-setup)
    - [Windows Server Setup For Local Deployment](#windows-server-setup-for-local-deployment)
- [Install Project using Git](#install-project-using-git)

# About Bisa App
Bisa App is a comprehensive mobile health platform designed to empower users with convenient access to healthcare services and information. With Bisa, users can consult with qualified medical professionals, access personalized health recommendations, and manage their health and wellness goals from the convenience of their smartphones. Our mission is to make quality healthcare accessible and affordable for everyone, leveraging technology to bridge the gap between users and healthcare providers. Join the Bisa community today and take control of your health journey!
Some key features of Bisa include:

-   Chat feature with audio, image and text support
-   Search for specialists and book video consultations
-   Search and book for lab tests from listed laboratories


Our platform is open to modifications by developers by its open source nature. With this in mind, the platform is built with the best standards and practices to ensure ease with expanding the code base and making it scalable. Learn more by exploring the documentation or seeing the code in the Github repository.  

# About this repository

### This repository contains all the various parts  of the Bisa Health App, this includes;
- [Backend](https://github.com/BisaMhealth/BisaApp/tree/backend)
- [Frontend](https://github.com/BisaMhealth/BisaApp/tree/frontend)
- [Admin](https://github.com/BisaMhealth/BisaApp/tree/Admin)
- [Mobile app](https://github.com/BisaMhealth/BisaApp/tree/mobile-app)

### All the web-based trees are written with PHP, Laravel and VueJs.

# Requirements
- Apache Server
- PHP 8.0 or above
- Laravel 8.0
- MySQL 8.0  
or  
- MariaDB 10.4.22


## Easy Installation

## Server Setup 
<hr /> <br />


#### Install XAMPP/WAMP Server
- Download XAMPP from here [XAMPP Download link](https://www.apachefriends.org/download.html)  or
- Download WampServer from here [WAMP Download](https://www.wampserver.com/en/download-wampserver-64bits/)


## Windows Server Setup For Local Deployment
<hr /> <br />

Use XAMPP or WAMP, if use XAMPP (PHP development environment) for installing php and Mysql or MariaDB server in windows local machine, for this case download xampp version 8.0 or above.

Once xampp is installed, update configure apache server if needed, in this case go to C:\xampp\php\php.ini and extend limit max_execution_time = 10000 , max_input_time = 10000, memory_limit = 2048M, post_max_size = 2048M, upload_max_filesize = 2048M .


### Composer Installation
Once XAMPP installed successfully, need to install composer if not installed on machine. To install composer please follow following steps. [Download link](https://getcomposer.org/download/)

Download and run Composer-Setup.exe - it will install the latest composer version whenever it is executed.
Once downloaded composer.exe, install this file and use command line path (C:\xampp\php\php.exe)

Now open the xampp server then run Apache and MySQL service.

Project folder path should be C:\xampp\htdocs 

To check composer version run this command in your CLI or command prompt

```shell
composer -v
```

### Node Installation and NPM
Install node from this [link](https://nodejs.org/en/download/current)
Run .exe file to install Node on your PC

Check your node version in your CLI with;
```shell
    node -v
```

## Install Project using Git for all web

```shell
    git clone https://github.com/BisaMhealth/BisaApp.git
    cp .env.example .env
    composer install
    php artisan storage:link
    php artisan key:generate
```

## Frontend dependencies for all web
```shell
    npm install
```


## Database setup
### Create a database for the project in localhost/phpmyadmin for local hosting and on your hosting if this is live.
### Configure database connection within the .env file.

```shell
    php artisan migrate
    php artisan db:seed
```
### Navigate to the various projects, repeat installation process for all web above


### Running the project
```shell
    php artisan serve
```

```shell
    npm run dev
```

### Check the VueJs documentation for how to run Laravel with VueJs

### Site URL Shoud Be Like
- http://localhost:"port number" 



### License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
