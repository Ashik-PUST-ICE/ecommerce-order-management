<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'admin', 'outlet_incharge'])->default('outlet_incharge');
            $table->foreignId('outlet_id')->nullable()->constrained()->onDelete('set null');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropForeign(['outlet_id']);
            $table->dropColumn('outlet_id');
            $table->dropSoftDeletes();
        });
    }
};
