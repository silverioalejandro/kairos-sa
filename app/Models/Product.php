<?php

namespace App\Models;

use App\Models\views\VCategory;
use App\Models\Views\VStatusProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'sku',
        'category_code',
        'price',
        'cover_price',
        'quantity',
        'quantity_factory',
        'status_product_code',
        'operator_id',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(VCategory::class, 'category_code');
    }

    public function statusProduct(): BelongsTo
    {
        return $this->belongsTo(VStatusProducts::class, 'status_product_code');
    }
}
