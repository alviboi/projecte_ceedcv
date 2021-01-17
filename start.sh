 #!/bin/bash
mv env-laradock ./laradock/.env
mv env-cefire ./cefire/.env
cd ./laradock

 sudo systemctl start docker
#  
 sudo docker-compose up -d nginx mysql phpmyadmin php-w /var/wwworker

 sudo docker-compose exec -it -w /var/www workspace bash php artisan key:generate
 sudo docker-compose exec -it -w /var/www workspace bash php artisan migrate:fresh
 sudo docker-compose exec -it -w /var/www workspace bash php composer install
 sudo docker-compose exec -it -w /var/www workspace bash php composer update
 sudo docker-compose exec -it -w /var/www workspace bash npm install
 sudo docker-compose exec -it -w /var/www workspace bash php artisan db:seed
 sudo docker-compose exec -it -w /var/www workspace bash npm run prod




 #sudo docker-compose exec -it -w /var/www workspace bash instalar.sh