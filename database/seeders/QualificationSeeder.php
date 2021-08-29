<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    private array $qualifications = [
        ['name' => 'Средняя', 'coefficient' => 1],
        ['name' => 'Высшая', 'coefficient' => 1.25],
        ['name' => 'Наивысшая', 'coefficient' => 1.5]
    ];

    public function run(): void
    {
        foreach ($this->qualifications as $q) {
            $qualification = new Qualification();
            $qualification->name = $q['name'];
            $qualification->coefficient = $q['coefficient'];
            $qualification->save();
        }
    }
}
