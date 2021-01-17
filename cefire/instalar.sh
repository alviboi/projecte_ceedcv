 #!/bin/bash
cd /var/www/
php artisan key:generate
php artisan migrate:fresh
/var/www/php composer install
/var/www/php composer update
npm install
php artisan db:seed
npm run prod
