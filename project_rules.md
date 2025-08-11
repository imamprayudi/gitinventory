# Project Rules - GitInventory Application

## Arsitektur Aplikasi

### Framework Stack
- **Backend**: Laravel 8.83 (PHP 8.1+)
- **Frontend**: Blade Templates + jQuery 3.6.3
- **Build Tools**: Laravel Mix + Vite
- **Database**: MySQL dengan Eloquent ORM
- **Asset Management**: Webpack via Laravel Mix

### Struktur Direktori
app/
├── Console/           # Artisan commands
├── Exceptions/        # Exception handlers
├── Http/
│   ├── Controllers/   # Application controllers
│   ├── Middleware/    # HTTP middleware
│   └── Requests/      # Form request validation
├── Models/            # Eloquent models
├── Providers/         # Service providers
└── Services/          # Business logic services

## Coding Standards

### PHP Standards
- Follow **PSR-4** autoloading standards
- Follow **PSR-12** coding style
- Use **strict types** declaration
- Implement proper **type hints**

### Laravel Conventions
- **Controllers**: PascalCase dengan suffix "Controller"
  ```php
  class InventoryController extends Controller
  ```

- **Models**: PascalCase singular
  ```php
  class Item extends Model
  ```

- **Migrations**: snake_case dengan timestamp
  ```php
  2024_01_01_000000_create_items_table.php
  ```

- **Views**: snake_case
  ```php
  resources/views/inventory/item_list.blade.php
  ```

- **Routes**: kebab-case
  ```php
  Route::get('/inventory-items', [InventoryController::class, 'index']);
  ```

### Database Guidelines

#### Migrations
```php
// Gunakan migrations untuk semua database changes
php artisan make:migration create_items_table

// Implement proper foreign key constraints
$table->foreignId('category_id')->constrained()->onDelete('cascade');

// Index columns yang sering di-query
$table->index(['status', 'created_at']);
```

#### Models
```php
// Implement soft deletes untuk data penting
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'description', 'quantity'];
    protected $dates = ['deleted_at'];
}
```

### Validation Rules
```php
// Gunakan Form Requests untuk validation
php artisan make:request StoreItemRequest

// Implement proper validation rules
public function rules()
{
    return [
        'name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:0',
        'image' => 'nullable|image|max:2048'
    ];
}
```

## Security Guidelines

### Input Validation
```php
// Selalu validate input
$request->validate([
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8|confirmed'
]);

// Sanitize output untuk prevent XSS
{{ $item->name }} // Auto-escaped
{!! $item->description !!} // Raw output (hati-hati)
```

### CSRF Protection
```html
<!-- Gunakan CSRF token di forms -->
<form method="POST" action="{{ route('items.store') }}">
    @csrf
    <!-- form fields -->
</form>
```

### Authorization
```php
// Implement proper authorization
Gate::define('update-item', function ($user, $item) {
    return $user->id === $item->user_id;
});

// Gunakan di controller
$this->authorize('update-item', $item);
```

## Testing Guidelines

### Unit Tests
```php
// Test business logic
php artisan make:test ItemTest --unit

public function test_item_can_be_created()
{
    $item = Item::factory()->create();
    $this->assertDatabaseHas('items', ['id' => $item->id]);
}
```

### Feature Tests
```php
// Test HTTP endpoints
php artisan make:test ItemControllerTest

public function test_user_can_view_items()
{
    $response = $this->get('/items');
    $response->assertStatus(200);
}
```

## Performance Guidelines

### Database Optimization
```php
// Use eager loading untuk prevent N+1 queries
$items = Item::with('category')->get();

// Use pagination untuk large datasets
$items = Item::paginate(15);

// Cache expensive queries
Cache::remember('items.all', 3600, function () {
    return Item::all();
});
```

### Asset Optimization
```javascript
// Minify assets untuk production
npm run prod

// Use CDN untuk external libraries
// Compress images sebelum upload
```

## Deployment Rules

### Environment Configuration
```bash
# Production environment
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gitinventory

# Cache configuration
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### Pre-deployment Checklist
- [ ] Run tests: `php artisan test`
- [ ] Clear caches: `php artisan cache:clear`
- [ ] Optimize autoloader: `composer install --optimize-autoloader --no-dev`
- [ ] Compile assets: `npm run prod`
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Set proper file permissions
- [ ] Configure web server (Apache/Nginx)
- [ ] Setup SSL certificate
- [ ] Configure backup strategy

## Git Workflow

### Branch Strategy
```bash
# Main branches
main        # Production-ready code
develop     # Integration branch

# Feature branches
feature/inventory-management
feature/user-authentication

# Hotfix branches
hotfix/critical-bug-fix
```

### Commit Messages
```bash
# Format: type(scope): description
feat(inventory): add item creation functionality
fix(auth): resolve login validation issue
docs(readme): update installation instructions
refactor(models): optimize database queries
```

## Monitoring & Logging

### Error Tracking
```php
// Log errors appropriately
Log::error('Item creation failed', [
    'user_id' => auth()->id(),
    'data' => $request->all()
]);

// Use different log levels
Log::info('User logged in', ['user_id' => $user->id]);
Log::warning('Low inventory detected', ['item_id' => $item->id]);
```

### Performance Monitoring
- Monitor database query performance
- Track application response times
- Monitor server resources
- Setup alerts untuk critical issues

## Documentation Requirements

### Code Documentation
```php
/**
 * Create a new inventory item
 *
 * @param StoreItemRequest $request
 * @return \Illuminate\Http\JsonResponse
 */
public function store(StoreItemRequest $request)
{
    // Implementation
}
```

### API Documentation
- Document all API endpoints
- Include request/response examples
- Specify authentication requirements
- Provide error code explanations

### README Updates
- Keep installation instructions current
- Document new features
- Update dependency requirements
- Include troubleshooting guides