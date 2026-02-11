<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->date('spent_at');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index('spent_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
