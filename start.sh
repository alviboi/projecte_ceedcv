 #!/bin/bash
 cd ./laradock
 sudo systemctl start docker
#  
 sudo docker-compose up -d nginx mysql phpmyadmin php-worker
 sudo docker-compose exec --user=laradock workspace bash /var/www/instalar.sh