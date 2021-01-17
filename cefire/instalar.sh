 #!/bin/bash

php artisan key:generate
php artisan migrate:fresh
composer install
composer update
npm install
php artisan db:seed
npm run prod
