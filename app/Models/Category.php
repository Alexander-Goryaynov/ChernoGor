<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property-read Collection|Subcategory[] $subcategories
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = false;

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
