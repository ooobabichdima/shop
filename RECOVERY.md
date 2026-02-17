# 🚨 Recovery Guide - Vendor Missing

## Problem
After restoring backup, the `vendor/` directory is missing. Laravel cannot run without it.

## Current Situation
```
✗ /home/user/shop/vendor - MISSING
✗ composer.lock - MISSING
✓ composer.json - EXISTS
✓ Code files - EXISTS (all git commits intact)
```

## Solution Options

### Option 1: Install from Composer (RECOMMENDED if network works)

```bash
cd /home/user/shop
composer install --no-interaction
```

**Status:** ⚠️ Currently failing with network error (403 tunnel failed)

### Option 2: Upload vendor.tar.gz

If you have a vendor backup archive:

```bash
# Upload vendor.tar.gz to /home/user/shop/
cd /home/user/shop
tar -xzf vendor.tar.gz
chmod -R 755 vendor
```

### Option 3: Copy from another Laravel project

If you have another Laravel 11 project with vendor:

```bash
cp -r /path/to/other/project/vendor /home/user/shop/
cd /home/user/shop
composer dump-autoload
```

### Option 4: Generate composer.lock first

```bash
cd /home/user/shop
# Create basic composer.lock
composer update --lock
# Then install
composer install
```

## After Vendor is Restored

### 1. Check Laravel works:
```bash
php artisan --version
```

### 2. Check database migrations:
```bash
php artisan migrate:status
```

### 3. Run pending migrations:
```bash
php artisan migrate --force
```

### 4. Seed database if needed:
```bash
php artisan db:seed --force
```

### 5. Clear caches:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### 6. Test the site:
```bash
# Visit these URLs:
https://shop.spf.org.ua/
https://shop.spf.org.ua/debug
```

## What Was Lost in Backup Restore?

Based on git history, **CODE IS SAFE**. All recent commits are present:
- ✅ Tuning kits feature
- ✅ Bundle section
- ✅ Price import
- ✅ Debug page
- ✅ Pagination fixes

**What might be lost:**
- ❌ Database records (if DB was also restored)
- ❌ Vendor dependencies (needs reinstall)
- ❌ Environment config (.env might be old)

## Quick Status Check

Visit: `https://shop.spf.org.ua/debug`

This will show:
- Database connection status
- Missing columns
- Products count
- Migrations status

## Contact

If none of these work, you may need to:
1. Check network/firewall settings for Composer
2. Download vendor.tar.gz from packagist.org manually
3. Or restore from a more recent backup that includes vendor/
