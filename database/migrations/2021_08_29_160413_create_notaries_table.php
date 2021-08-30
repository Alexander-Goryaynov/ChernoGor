<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotariesTable extends Migration
{

    public function up(): void
    {
        Schema::create('notaries', function (Blueprint $table) {
            $table->id();
            $table->string('fio');
            $table->string('description');
            $table->string('photo_path');
            $table->string('office_address');
            $table->json('schedule');
            $table->foreignId('qualification_id')
                ->constrained('qualifications')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('notaries');
    }
}
