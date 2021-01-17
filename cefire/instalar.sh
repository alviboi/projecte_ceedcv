 #!/bin/bash
php artisan migrate:fresh
php composer update
npm install
php artisan db:seed
npm run prod
