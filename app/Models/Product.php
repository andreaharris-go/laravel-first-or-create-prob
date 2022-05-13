<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
