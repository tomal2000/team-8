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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->enum('id_type',['nid','birth_certificate','others'])->nullable();
            $table->string('national_id')->nullable();
            $table->string('mobile')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->decimal('balance')->default(0);
            $table->boolean('is_payment_collector')->default(false);
            $table->string('photo')->nullable();
            $table->string('id_picture')->nullable();
            $table->string('signature')->nullable();
            $table->enum('status',['operative','inactive','hold','suspended'])->default('operative');
            $table->enum('password_status',['default','primary'])->default('default');
            $table->longText('meta')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
