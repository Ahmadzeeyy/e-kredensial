<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kredensials', function (Blueprint $table) {
            if (!Schema::hasColumn('kredensials', 'data_form3a')) {
                $table->json('data_form3a')->nullable()->after('data_form7');
            }
            if (!Schema::hasColumn('kredensials', 'data_form3b')) {
                $table->json('data_form3b')->nullable()->after('data_form3a');
            }
            if (!Schema::hasColumn('kredensials', 'data_form3d')) {
                $table->json('data_form3d')->nullable()->after('data_form3b');
            }
            if (!Schema::hasColumn('kredensials', 'data_form9')) {
                $table->json('data_form9')->nullable()->after('data_form3d');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kredensials', function (Blueprint $table) {
            $table->dropColumn(['data_form3a', 'data_form3b', 'data_form3d', 'data_form9']);
        });
    }
};
