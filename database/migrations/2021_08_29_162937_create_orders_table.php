<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->json('description');
            $table->float('price');
            $table->string('status');
            $table->timestamp('consultation_datetime');
            $table->timestamps();
            $table->string('user_email');
            $table->foreign('user_email')
                ->references('email')
                ->on('users')
                ->cascadeOnUpdate();
            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('subcategories')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('notary_id')
                ->nullable()
                ->constrained('notaries')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
