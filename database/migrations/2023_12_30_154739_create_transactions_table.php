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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transactionable_id');
            $table->string('transactionable_type');
            $table->string('transaction_id');
            $table->string('reference_id')->nullable();
            $table->unsignedBigInteger('gateway_id')->nullable();
            $table->unsignedBigInteger('initiator')->nullable();
            $table->unsignedBigInteger('approver')->nullable();
            $table->enum('type',['debit','credit']);
            $table->string('module');
            $table->string('narration',1000);
            $table->longText('description')->nullable();
            $table->decimal('principal_amount')->default(0);
            $table->decimal('fee')->default(0);
            $table->decimal('amount')->default(0);
            $table->decimal('remain_balance')->default(0);
            $table->longText('meta')->nullable();
            $table->enum('status',['initiated','pending','processing','completed','reverted','hold','reversed'])->default('initiated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
