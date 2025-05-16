<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_add_is_featured_to_courses_table.php
public function up()
{
    Schema::table('courses', function (Blueprint $table) {
        $table->boolean('is_featured')->default(false)->after('price');
    });
}

public function down()
{
    Schema::table('courses', function (Blueprint $table) {
        $table->dropColumn('is_featured');
    });
}
};
