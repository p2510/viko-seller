<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','on_sale','price','sale_price','description','brand','quantity','category_id','user_id'
    ];
    
    public function getRouteKeyName():string{
        return 'name';
    }

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get all of the product_photo for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_photos(): HasMany
    {
        return $this->hasMany(ProductPhoto::class, 'product_id', 'id');
    }
 
    
}