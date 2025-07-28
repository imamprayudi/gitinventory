# User Rules - GitInventory Application

## Persyaratan Sistem

### Versi yang Diperlukan
- **PHP**: v8.1+ (sesuai dengan Laravel 8)
- **Laravel**: v8.83
- **MySQL**: v5.7+ atau v8.0+
- **Redis**: v6.x+ untuk caching dan session
- **Node.js**: v16.x+ untuk asset compilation
- **Composer**: v2.x+

### Development Tools
- **Laragon**: Recommended local development environment
- **Git**: Version control
- **VS Code/PHPStorm**: IDE dengan PHP extensions
- **Postman/Insomnia**: Untuk API testing

## Workflow Pengembangan

### 1. Setup Awal
```bash
# Clone project
git clone [repository-url]
cd gitinventory

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database (jika tersedia)
php artisan db:seed
```

### 2. Command Harian Development
```bash
# Start development server
php artisan serve

# Watch untuk perubahan asset
npm run watch
# atau menggunakan Vite
npm run dev

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Run tests
php artisan test
# atau
vendor\bin\phpunit
```

### 3. Asset Management
```bash
# Development build
npm run dev

# Production build
npm run prod

# Watch mode (auto-compile)
npm run watch

# Hot reload (jika menggunakan Vite)
npm run hot
```

## Panduan Penggunaan

### Authentication
- Login menggunakan kredensial yang telah terdaftar
- Sistem menggunakan Laravel's built-in authentication
- Session management otomatis

### Inventory Management
- Tambah, edit, hapus item inventory
- Upload gambar untuk item
- Export data ke Excel menggunakan PhpSpreadsheet
- Filter dan pencarian data

### User Management
- Role-based access control
- User registration dan profile management
- Password reset functionality

## Troubleshooting

### Common Issues
1. **Server Error 500**
   - Check Laravel logs di `storage/logs/`
   - Verify database connection
   - Clear all caches

2. **Asset Not Loading**
   - Run `npm run dev` atau `npm run prod`
   - Check file permissions
   - Verify asset paths

3. **Database Issues**
   - Check `.env` database configuration
   - Verify database exists
   - Run migrations: `php artisan migrate`

4. **Permission Issues**
   - Set proper permissions untuk `storage/` dan `bootstrap/cache/`
   - Windows: `icacls storage /grant Users:F /T`

### Log Files
- **Laravel Logs**: `storage/logs/laravel.log`
- **Web Server Logs**: Check Laragon logs
- **Database Logs**: MySQL error logs

## Best Practices

### Security
- Selalu validate input
- Use CSRF protection
- Sanitize output
- Keep dependencies updated
- Use HTTPS di production

### Performance
- Use caching untuk data yang sering diakses
- Optimize database queries
- Compress assets untuk production
- Use CDN untuk static assets

### Backup
- Regular database backup
- Backup uploaded files
- Version control untuk code changes