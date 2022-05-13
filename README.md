# laravel-first-or-create-prob
Lab check firstOrCreate duplicate records

## Installation
```
composer install

cp .env.example .env

php artisan key:generate

php artisan horizon:install

php artisan migrate

php artisan horizon
```

## new tab
```
php artisan serve
```

## new tab more
```
php artisan create-products
```


## description
### Models
```php
class Product extends Model 
{
    /**
     * @var string $table
     */
    protected $table = 'products';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'uuid',
    ];
}
```

### Jobs
```php
class CreateProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public function handle()
    {
        Product::firstOrCreate(['uuid' => $this->uuid]);
    }
}
```

### Command
```php
class CreateProductsCommand extends Command
{
    protected $signature = 'create-products';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $uuid = (string) Uuid::uuid4();

        foreach(range(1, 5) as $i) {
            dispatch(new CreateProductJob($uuid));
        }
    }
}
```
