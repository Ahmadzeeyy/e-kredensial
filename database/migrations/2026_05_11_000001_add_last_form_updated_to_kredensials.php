<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kredensials', function (Blueprint $table) {
            $table->string('last_form_updated')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('kredensials', function (Blueprint $table) {
            $table->dropColumn('last_form_updated');
        });
    }
};
