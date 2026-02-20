<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workspaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', ['private', 'desk', 'meeting', 'virtual']);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('capacity')->default(1);
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workspaces');
    }
};