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
        Schema::table('dokter', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('id_dokter')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('dokter', function (Blueprint $table) {
        // Drop foreign key constraint
        $table->dropForeign(['user_id']); // Hapus constraint pada kolom user_id
        
        // Drop the column
        $table->dropColumn('user_id');
    });
}

};
