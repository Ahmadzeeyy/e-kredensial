<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kredensials', function (Blueprint $table) {
            if (!Schema::hasColumn('kredensials', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->after('id');
            }
            if (!Schema::hasColumn('kredensials', 'status')) {
                $table->string('status')->default('Submitted')->after('user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kredensials', function (Blueprint $table) {
            if (Schema::hasColumn('kredensials', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
            if (Schema::hasColumn('kredensials', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
