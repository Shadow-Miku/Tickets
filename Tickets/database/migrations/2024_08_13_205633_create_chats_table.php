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
        Schema::create('chats', function (Blueprint $table) {
            $table->id(); //Primary key
            $table->foreignId('assignment_id')->constrained('assignments'); // Foreign key
            $table->text('answer')->nullable(); // Accountable
            $table->text('comentary')->nullable(); // User
            $table->text('observation')->nullable(); // Admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
