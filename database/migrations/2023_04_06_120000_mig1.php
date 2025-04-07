<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('pet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->text('name');
            $table->text('type');
            $table->text('breed');
            $table->integer('age');
        });
        Schema::create('groomer', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('last_name');
            $table->text('phone')->unique();
            $table->text('spicialization');
        });
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('description');
            $table->integer('price');
            $table->integer('duration(min)');
        });
        Schema::create('appointment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->nullable()->index();
            $table->foreignId('groomer_id')->nullable()->index();
            $table->foreignId('service_id')->nullable()->index();
            $table->text('date');
            $table->text('status');
            $table->text('notes');
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('last_activity');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('pet');
        Schema::dropIfExists('groomer');
        Schema::dropIfExists('service');
        Schema::dropIfExists('appointment');
        Schema::dropIfExists('sessions');
    }
};
