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
        Schema::create('coments', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('user_id')->constrained();
            $table->foreignId('coment_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('text',200);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coments');
    }
};
