# Introducció

Es tracta d'una aplicació per permetre el fitxatge d'assessors del CEFIRE, per  poder fer-lo funcionar, es recomana instal·lar-lo en un servidor independent. Totes les proves s'han fet en una Ubuntu 20.04

# Clonar el projecte

Per a clonar el projecte podem utilitzar el següent comandament:

```
git clone --recurse-submodules https://github.com/alviboi/projecte_ceedcv
```

# Instal·lació de l'aplicació

Una vegada descarregat, hem executar el següent comandament que trobarem dins de la carpeta arrel:

```
./start.sh
```

Per a poder entrar en el workspace del docker, pots utilitzar el següent comandament:


    sudo docker-compose exec --user=laradock workspace bash


L'usuari per a poder entrat es admin@admin, i la contrasenya admin. Es recomana llegir l'ajuda de l'aplicació per a veure com funciona

# Dispositiu de fixatges

Podeu consultar el [següent projecte](https://github.com/alviboi/arduino_lector_rfid) per veure un prototip del dispositiu de fitxatge que es podria utilitzar.

# Opcions

Podeu habilitar ssl en nginx, entrant a l'arxiu ./laradock/nginx/sites/default.conf i descomentant el següent paràmetres:

```
# For https
    listen 443 ssl default_server;
    listen [::]:443 ssl default_server ipv6only=on;
    ssl_certificate /etc/nginx/ssl/default.crt;
    ssl_certificate_key /etc/nginx/ssl/default.key;
```

Abans d'aplicar el script de start.sh, i si aneu a utilitzar la importació de LDAP cal canviar l'arxiu ./laradock/php-fpm/Dockerfile el paràmetre INSTALL_LDAP a true

```
    ARG INSTALL_LDAP=true
```

A l'arxiu ./laradock/workspace/Dockerfile canviar el següent:

```
    ARG INSTALL_LDAP=false

    RUN if [ ${INSTALL_LDAP} = true ]; then \

        apt-get install -y libldap2-dev && \
        apt-get install -y php${LARADOCK_PHP_VERSION}-ldap \
    ;fi
```
per

```
    ARG INSTALL_LDAP=true

    RUN if [ ${INSTALL_LDAP} = true ]; then \
        apt-get update && \
        apt-get install -y libldap2-dev && \
        apt-get install -y php${LARADOCK_PHP_VERSION}-ldap \
    ;fi
```

