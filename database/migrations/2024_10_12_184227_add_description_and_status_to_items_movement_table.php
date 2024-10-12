<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionAndStatusToItemsMovementTable extends Migration
{
    public function up()
    {
        Schema::table('items_movements', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->enum('status', ['in', 'out'])->default('in'); // Default status can be set to 'in'
        });
    }

    public function down()
    {
        Schema::table('items_movements', function (Blueprint $table) {
            $table->dropColumn(['description', 'status']);
        });
    }
}
