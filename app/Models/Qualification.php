<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property float $coefficient
 * @property-read Collection|Notary[] $notaries
 */
class Qualification extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function notaries()
    {
        return $this->hasMany(Notary::class);
    }
}
