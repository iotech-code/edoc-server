#!/bin/sh

echo "Starting Getters..."
echo "Linking storage"
php /var/www/artisan storage:link
touch /var/www/storage/logs/laravel.log
chmod 777 -R /var/www/storage/logs /var/www/storage/framework /var/www/storage/app /var/www/bootstrap/cache
chown www-data:www-data storage/logs/laravel.log bootstrap/
echo "Running service..."
exec /usr/bin/supervisord -n -c /supervisord.conf