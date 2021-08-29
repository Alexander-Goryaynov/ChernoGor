<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
