<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kredensials', function (Blueprint $table) {
            $table->json('data_form7')->nullable()->after('data_form6');
        });
    }

    public function down(): void
    {
        Schema::table('kredensials', function (Blueprint $table) {
            $table->dropColumn('data_form7');
        });
    }
};
