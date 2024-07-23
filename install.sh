#!/bin/bash
docker-compose -f docker/docker-compose.yaml up -d
echo "################################################"
echo "##          Installing dependencies           ##"
echo "################################################"
docker exec -ti openhost-php composer install
echo "################################################"
echo "##                Crear database              ##"
echo "################################################"
docker exec -it openhost-php php bin/console doctrine:database:create
docker exec -it openhost-php php bin/console doctrine:schema:update --force
docker exec -it openhost-php php bin/console doctrine:fixture:load
docker exec -ti openhost-php php bin/console assets:install
echo "################################################"
echo "##                Clear cache                 ##"
echo "################################################"
docker exec -ti openhost-php php bin/console cache:clear --env prod
echo "################################################"
echo "##     Running on http://localhost:8080/      ##"
echo "################################################"
sudo mkdir -p site/web/uploads/xs/
sudo mkdir -p site/web/uploads/sm/
sudo mkdir -p site/web/uploads/md/
sudo mkdir -p site/web/uploads/lg/
sudo mkdir -p site/web/uploads/xl/
sudo mkdir -p site/web/uploads/or/
sudo chmod -R 777 site/var/
sudo chmod -R 777 site/web/
sudo chmod -R 777 site/web/uploads
