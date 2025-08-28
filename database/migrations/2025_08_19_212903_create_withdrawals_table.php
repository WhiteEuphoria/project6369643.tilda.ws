<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->text('requisites'); // Реквизиты для вывода
            $table->string('status')->default('В обработке'); // Статусы: В обработке, Выполнено, Отклонено
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('withdrawals');
    }
};
