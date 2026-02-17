#!/bin/bash

echo "🔄 Running database migrations..."

# Check if vendor directory exists
if [ ! -d "vendor" ]; then
    echo "❌ Vendor directory not found. Please run 'composer install' first."
    exit 1
fi

# Run migrations
php artisan migrate --force

echo "✅ Migrations completed!"

# Optionally seed the database
read -p "Do you want to seed the database? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan db:seed --force
    echo "✅ Database seeded!"
fi

echo "Done!"
