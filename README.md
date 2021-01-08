<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Installation Steps

Download zip file and extract id / or get clone from git.

Run Following commands

 - composer install
 - npm install && npm run dev
 - cp .env.example .env
   - configure parameters in .env file
   - create database in mysql and update DB_HOST, DB_USER, DB_DATABASE and DB_PASSWORD in .env file
   - Replace APP_URL value with domain
 - php artisan generate:keys
 - php artisan migrate
 - php artisan passport:install
   - copy 2nd record and set it to .env PASSPORT_CLIENT_SECRETE replace with it's value
 - php artisan l5-swagger:generate
 - php artisan serve
   - in case of running local apache server

## API Documentation Path

    http://domain/api/documentation

## Application URL

    http://domain

## Application API Endpoints

    http://domain/api

## Application Admin URL

    http://domain/admin/login
