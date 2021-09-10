<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $fio
 * @property string $description
 * @property string $photo_path
 * @property string $office_address
 * @property string $schedule
 * @property int $qualification_id
 * @property-read Collection|Order[] $orders
 * @property-read Qualification $qualification
 */
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
