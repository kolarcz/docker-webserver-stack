# Docker Webserver Stack
Docker with Nginx proxy + Lets Encrypt Certbot + PHP + MariaDB + NodeJS app + external app

Host | Target
--- | ---
localhost | PHP: /home/php/src/localhost/_/
mujweb1.cz | PHP: /home/php/src/mujweb1.cz/_/
www.mujweb1.cz | PHP: /home/php/src/mujweb1.cz/www/
nodejsappka.mujweb2.cz | Container "nodejsappka" (NodeJS app)
homeassistant.mujweb2.cz | App running on local machine at port 8123
```
cd /home
docker-compose up # -d
```

## How to add access to MariaDB with "root" also from local machine:
```
docker exec -it <db_container_id> mysql -uroot -p
CREATE USER 'root'@'172.18.0.1' IDENTIFIED BY 's3cretP4ss';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'172.18.0.1' WITH GRANT OPTION;
flush privileges;
exit
```

## Setting up HTTPS:
```
chmod -R 755 /home/certbot
docker-compose up -d # for the first time comment "HTTPS" section in nginx.conf
docker-compose run --rm certbot certonly --webroot --webroot-path /var/www/certbot/ -d mujweb1.cz,www.mujweb1.cz
docker-compose run --rm certbot certonly --webroot --webroot-path /var/www/certbot/ -d mujweb2.cz,nodejsappka.mujweb2.cz,homeassistant.mujweb2.cz
chmod -R 755 /home/certbot
```

### Manual cert renew (possibly also with: "--force-renewal")
```
docker-compose run --rm certbot renew
```
