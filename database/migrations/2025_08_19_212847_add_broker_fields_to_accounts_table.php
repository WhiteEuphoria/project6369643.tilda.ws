<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('client_initials')->after('bank');
            $table->string('broker_initials')->after('client_initials');
        });
    }
    public function down(): void {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn(['client_initials', 'broker_initials']);
        });
    }
};
