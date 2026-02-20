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
        Schema::create('remark', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->string('status');
            $table->boolean('private')->default(false);
            $table->string('ip_address');
            $table->foreignId('session_id')->constrained('session')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remark');
    }
};
