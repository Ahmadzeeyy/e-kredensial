<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Update tabel kredensials
        Schema::table('kredensials', function (Blueprint $table) {
            $table->string('status')->default('Submitted')->after('data_asesor'); // Submitted, Under Review, Needs Revision, Approved
            $table->date('str_expiry')->nullable()->after('status');
            $table->text('notes')->nullable()->after('str_expiry'); // Untuk alasan revisi
        });

        // Tabel Activity Logs
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('activity');
            $table->string('target_type')->nullable();
            $table->unsignedBigInteger('target_id')->nullable();
            $table->text('details')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('kredensials', function (Blueprint $table) {
            $table->dropColumn(['status', 'str_expiry', 'notes']);
        });
        Schema::dropIfExists('activity_logs');
    }
};
