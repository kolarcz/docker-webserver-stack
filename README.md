# Docker Webserver Stack
> Nginx proxy + PHP + MariaDB + NodeJS app + external app + LetsEncrypt Certbot

Host | Target
--- | ---
localhost | PHP: `/home/php/src/_.localhost/_/`
mujweb1.cz | PHP: `/home/php/src/mujweb1.cz/_/`
www.mujweb1.cz | PHP: `/home/php/src/mujweb1.cz/www/`
nodejsappka.mujweb2.cz | NodeJS app as container "nodejsappka"
homeassistant.mujweb2.cz | External app running on local machine at port 8123
```
cd home
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
Un/comment:
- [./home/docker-compose.yml](./home/docker-compose.yml): **lines 16-22**
- [./home/nginx/nginx.conf](./home/nginx/nginx.conf): **lines 14, 16-22, 39-56**
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
