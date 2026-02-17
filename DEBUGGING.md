# 🔍 Debugging Guide

## If you're getting 500 error, follow these steps:

### 1. Check Debug Page
Visit: `http://your-domain/debug`

This page will show you:
- Database connection status
- Table structure
- Missing columns
- Product data
- Recent errors

### 2. Run Migrations

If the debug page shows "tuning_kits column MISSING", run:

```bash
# Option 1: Using artisan directly
php artisan migrate --force

# Option 2: Using the provided script
bash migrate.sh
```

### 3. Check .env file

Make sure you have `.env` file with these settings:

```env
APP_ENV=local
APP_DEBUG=true
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

If `.env` doesn't exist:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Check Logs

After trying to access the page, check logs:
```bash
tail -f storage/logs/laravel.log
```

### 5. Clear Cache

Sometimes cache causes issues:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### 6. Common Issues

#### Missing tuning_kits column
**Error:** Column 'tuning_kits' not found

**Fix:** Run the migration:
```bash
php artisan migrate --force
```

#### No products in database
**Error:** Call to a member function on null

**Fix:** Seed the database:
```bash
php artisan db:seed --force
```

#### Recommended products relationship error
**Error:** Call to undefined relationship

**Fix:** Check if Product model has `recommended()` relationship defined.

### 7. Quick Test Commands

```bash
# Test database connection
php artisan tinker
>>> DB::connection()->getPdo();

# Check if products exist
>>> App\Models\Product::count();

# Check first product
>>> $p = App\Models\Product::first();
>>> $p->tuning_kits;
>>> $p->recommended;
```

## Support

If issue persists:
1. Visit `/debug` page
2. Copy the error message
3. Check `storage/logs/laravel.log`
4. Provide the full error trace
