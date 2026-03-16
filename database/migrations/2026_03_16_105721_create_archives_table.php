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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->longText('document');
            $table->string('file_name');
            $table->date('adding_date');
            $table->string('teacher_name');
            $table->string('teacher_email');
            $table->string('survey_name');
            $table->text('survey_description');
            $table->string('survey_question');
            $table->string('session_class')->nullable();
            $table->string('session_remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
