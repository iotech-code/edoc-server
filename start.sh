#!/bin/sh

echo "Starting Getters..."
echo "Linking storage"
php /var/www/html/artisan storage:link
touch /var/www/storage/logs/laravel.log
chmod 777 -R /var/www/html/storage/logs /var/www/html/storage/framework /var/www/html/storage/app /var/www/html/bootstrap/cache
chown www-data:www-data storage/logs/laravel.log bootstrap/
echo "Running service..."
exec /usr/bin/supervisord -n -c /supervisord.conf