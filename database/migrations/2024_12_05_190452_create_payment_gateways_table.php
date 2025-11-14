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
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_method_id');
            $table->string('unique_id')->unique();
            $table->string('name');
            $table->string('name_bangla');
            $table->enum('fee_type',['flat','percentage'])->nullable();
            $table->decimal('fee')->default(0);
            $table->string('logo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->longText('meta')->nullable();
            $table->boolean('is_confirmed')->default(true);
            $table->decimal('balance')->default(0);
            $table->timestamps();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_gateways');
    }
};
