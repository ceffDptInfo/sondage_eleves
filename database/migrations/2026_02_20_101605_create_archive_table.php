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
        Schema::create('archive', function (Blueprint $table) {
            $table->id();
            $table->blob('document');
            $table->string('filename');
            $table->string('teacher_name');
            $table->string('teacher_mail_address');
            $table->string('survey_name');
            $table->string('survey_description');
            $table->string('survey_question');
            $table->string('session_class');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive');
    }
};
