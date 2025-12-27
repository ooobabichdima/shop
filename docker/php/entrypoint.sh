#!/bin/sh

# Entrypoint script for Laravel container
# Sets proper permissions and starts php-fpm

echo "Setting permissions..."

# Create directories if they don't exist
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Set ownership
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache

# Set permissions
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

echo "Permissions set successfully"

# Execute the main command (php-fpm)
exec "$@"
