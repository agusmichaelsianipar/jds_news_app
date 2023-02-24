<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## SYSTEM REQUIREMENTS
- PHP 7.4.30
- Composer 2.4.2
- MySQL 15.3
- Postman 10.10.7

## HOW TO INSTALL
- Please make sure you have compatible system
- Clone this project into your local machine
> git clone https://github.com/agusmichaelsianipar/jds_news_app.git
- Move your terminal directory into the project
> cd jds_news_app
- Install composer dependecies
> composer install
- Install NPM dependecies
> NPM install
- Create a copy of your .env file
> cp .env.example .env
- Generate an app encryption key
> php artisan key:generate
- Make sure your database is well set-up
- Install Laravel Passport
> composer require laravel/passport
- Migrate your database
> php artisan migrate
- Install Laravel Passport
> php artisan passport:install

*DONE*

## POSTMAN COLLECTION LINK
https://www.postman.com/agusmichaelsianipar/workspace/jds-workspace/collection/25289606-5b2a589d-3c0c-4b80-b8ab-e0ae5b28e9d3?action=share&creator=25289606
