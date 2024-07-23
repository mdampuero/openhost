#!/bin/bash
echo "################################################"
echo "##                Update database             ##"
echo "################################################"
docker exec -it openhost-php php bin/console doctrine:schema:update --force
echo "################################################"
echo "##                Install assets              ##"
echo "################################################"
docker exec -ti openhost-php php bin/console assets:install
echo "################################################"
echo "##                Clear cache                 ##"
echo "################################################"
docker exec -ti openhost-php php bin/console cache:clear --env prod
docker exec -ti openhost-php php bin/console cache:clear 
