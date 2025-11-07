<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('akun_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_id')->constrained('akun')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained('item')->cascadeOnDelete();
            $table->integer('jumlah')->default(1);
            $table->decimal('harga_jual', 12, 2)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_item');
    }
};
