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
        Schema::table('items_movements', function (Blueprint $table) {
            //
            $table->boolean('closed')->default(false); // Add closed column

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items_movements', function (Blueprint $table) {
            $table->dropColumn('closed');
        });
    }
};
