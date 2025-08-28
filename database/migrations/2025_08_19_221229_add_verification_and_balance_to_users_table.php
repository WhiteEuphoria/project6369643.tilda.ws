<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('verification_status')->default('pending')->after('is_admin');
            $table->decimal('main_balance', 15, 2)->default(0)->after('verification_status');
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['verification_status', 'main_balance']);
        });
    }
};
