<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id(); $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name'); $table->string('number'); $table->string('bank');
            $table->date('term'); $table->string('status'); $table->timestamps();
        });
        Schema::create('transit_accounts', function (Blueprint $table) {
            $table->id(); $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('account_details'); $table->decimal('balance', 15, 2); $table->timestamps();
        });
        Schema::create('fraud_claims', function (Blueprint $table) {
            $table->id(); $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('details');
            $table->string('status')->default('В рассмотрении'); // Status default (legacy): В рассмотрении
            $table->timestamps();
        });
        Schema::create('documents', function (Blueprint $table) {
            $table->id(); $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('path'); $table->string('original_name'); $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('documents'); Schema::dropIfExists('fraud_claims');
        Schema::dropIfExists('transit_accounts'); Schema::dropIfExists('accounts');
    }
};
