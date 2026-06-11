#!/bin/sh
# docker/entrypoint.prod.sh
set -e

echo "Optimisation Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Démarrage php-fpm..."
exec php-fpm