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
        Schema::create('school_dropout_surveys', function (Blueprint $table) {
            $table->id();

            // === TAB 1: Datos generales ===
            $table->string('name')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('career')->nullable();
            $table->unsignedTinyInteger('semester')->nullable();
            $table->boolean('working')->nullable();

            // === TAB 2: Factores personales ===
            $table->enum('motivation', [
                'Muy motivado(a)',
                'Algo motivado(a)',
                'Neutral',
                'Poco motivado(a)',
                'Nada motivado(a)'
            ])->nullable();
            $table->boolean('abandon')->nullable();
            $table->string('reason')->nullable();
            $table->enum('emotional_state', [
                'Estable',
                'Ansioso(a)',
                'Estresado(a)',
                'Triste',
                'Otro'
            ])->nullable();
            $table->boolean('support')->nullable();
            $table->boolean('economic_pillar')->nullable();
            $table->boolean('far_from_university')->nullable();

            // === TAB 3: Factores académicos ===
            $table->enum('academic_performance', [
                'Muy alto',
                'Alto',
                'Adecuado',
                'Bajo',
                'Muy bajo'
            ])->nullable();
            $table->boolean('has_failed')->nullable();
            $table->boolean('professor_support')->nullable();
            $table->boolean('resources_access')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_dropout_surveys');
    }
};
