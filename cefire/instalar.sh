 #!/bin/bash

composer install
composer update
npm install
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed
npm run prod

