 #!/bin/bash
cd /var/www/
php artisan key:generate
php artisan migrate:fresh
php composer install
php composer update
npm install
php artisan db:seed
npm run prod
