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
        Schema::table('users', function (Blueprint $table) {
            //$table->renameColumn('`name`', '`username`');
            $table->dropColumn('name');
            $table->string('username')->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //$table->renameColumn('`username`', '`name`');
            $table->dropColumn('username');
            $table->string('name')->after('id');
        });
    }
};
