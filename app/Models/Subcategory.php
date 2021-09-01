<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $category_id
 * @property-read Category $category
 * @property-read Collection|Order[] $orders
 */
class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
