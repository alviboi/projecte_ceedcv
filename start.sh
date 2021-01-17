 #!/bin/bash
mv env-laradock ./laradock/.env
mv env-cefire ./cefire/.env
cd ./laradock

 sudo systemctl start docker
#  
 sudo docker-compose up -d nginx mysql phpmyadmin php-worker

 sudo docker-compose exec workspace bash /var/www/php artisan key:generate
 sudo docker-compose exec workspace bash /var/www/php artisan migrate:fresh
 sudo docker-compose exec workspace bash /var/www//var/www/php composer install
 sudo docker-compose exec workspace bash /var/www//var/www/php composer update
 sudo docker-compose exec workspace bash /var/www/npm install
 sudo docker-compose exec workspace bash /var/www/php artisan db:seed
 sudo docker-compose exec workspace bash /var/www/npm run prod




 #sudo docker-compose exec workspace bash /var/www/instalar.sh