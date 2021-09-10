<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $description
 * @property float $price
 * @property string $status
 * @property string $consultation_datetime
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $notary_id
 * @property int $subcategory_id
 * @property int $user_id
 * @property-read Notary|null $notary
 * @property-read Subcategory|null $subcategory
 * @property-read User $user
 */
class Order extends Model
{
    use HasFactory;

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function notary()
    {
        return $this->belongsTo(Notary::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
