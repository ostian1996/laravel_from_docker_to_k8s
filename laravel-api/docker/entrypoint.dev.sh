#!/bin/sh
set -e

# Remet les permissions à chaque démarrage
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

exec "$@"