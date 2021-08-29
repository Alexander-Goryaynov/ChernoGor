<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notary extends Model
{
    use HasFactory;

    protected $table = 'notaries';
    public $timestamps = false;

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
