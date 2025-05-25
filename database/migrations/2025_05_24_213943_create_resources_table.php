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
    Schema::create('resources', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('url'); // lien vers le fichier ou ressource
        $table->string('icon')->nullable(); // classe d'icône font-awesome
        $table->foreignId('course_id')->constrained()->onDelete('cascade'); // lien avec cours
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
