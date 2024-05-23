#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
  composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
  echo "Creating env file for env $APP_ENV"
  cp .env.example .env
else
  echo "Env file already exists"
fi

php artisan migrate
php artisan key:generate
php artisan storage:link
php artisan cache:clear
php artisan route:clear

php-fpm
