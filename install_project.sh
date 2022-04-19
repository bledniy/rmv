#!/bin/bash

if [ -d "vendor" ]; then
  if [ -f ".env" ]; then
    php artisan backup:run > /dev/null 2>&1
  fi
fi


#linux command only
installdbname=$(cat .env | grep DB_DATABASE)
installdbname="${installdbname//DB_DATABASE=/}"

sed -i '/DB_DATABASE/c\DB_DATABASE=' .env
composer install --ignore-platform-reqs
php artisan db:create $installdbname
#windows: copy .htaccess.example .htaccess
cp .htaccess.example .htaccess
#linux command only
sed -i "/DB_DATABASE/c\DB_DATABASE=$installdbname" .env
php artisan migrate:fresh --seed
php artisan storage:link
php artisan key:generate

echo 'Доступы в админку: admin'
echo $(php artisan pass admin)